<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user.read', ['only' => ['index', 'datatable']]);
        $this->middleware('permission:user.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user.update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        $roles = Role::get();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable',
            'role' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make(Str::random(12)),
        ])->assignRole($request->input('role'));

        return redirect()->intended(route('users.index'))->with('success', 'User has been added successfully.');
    }

    public function edit($id)
    {
        $user = User::whereId($id)->with('roles')->first();
        if (empty($user)) abort(404);
        
        $roles = Role::get();

        return view('user.create', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable',
            'role' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $user = User::whereId($id)->first();
        if (empty($user)) abort(404);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $user->syncPermissions($request->input('role'));

        return redirect()->intended(route('users.index'))->with('success', 'User has been updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        if (empty($user)) abort(404);

        $user->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $user = User::get();
        $dt = DataTables::of($user);

        $dt->addColumn('name', function ($record) {
            if (auth()->user()->can('user.update')) {
            return '<a href="' . route('users.edit', $record->id) . '">' . $record->name . '</a>';
            }

            return $record->name;
        });

        $dt->addColumn('email', function ($record) {
            return $record->email;
        });

        $dt->addColumn('role', function ($record) {
            return optional($record->roles->first())->name;
        });

        $dt->addColumn('actions', function ($record) {
            $deleteBtn = $updateBtn = '';

            if (auth()->user()->can('user.update')) {
                $updateBtn = '<a href="' . route('users.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#users-dt">
                        <span class="ni ni-trash"></span>
                    </a>';
            }

            if (auth()->user()->can('user.delete')) {
                $deleteBtn = '<a href="' . route('users.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
            }

            return $deleteBtn . $updateBtn ;
        });

        $dt->rawColumns(['name', 'email', 'role', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
