<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
        ])->assignRole($request->input('role'));

        return redirect()->intended(route('users.index'))->with('success', 'User has been added successfully.');
    }

    public function edit($id)
    {
        $user = User::whereId($id)->first();
        if (empty($user)) abort(404);

        return view('user.create', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $user = User::whereId($id)->first();
        if (empty($user)) abort(404);

        $user->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

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
            return '<a href="' . route('users.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('email', function ($record) {
            return $record->email;
        });

        $dt->addColumn('role', function ($record) {
            return $record->roles->first()->name;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('users.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#users-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('users.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'email', 'role', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
