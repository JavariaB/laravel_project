<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('role.create', compact('permissions')); // pass $permissions to role.create view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'permissions.required' => 'Please, select at least one permission.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        Role::create([
            'name' => $request->input('name'),
        ])->syncPermissions($request->input('permissions'));

        return redirect()->intended(route('roles.index'))->with('success', 'Role has been added successfully.');
    }

    public function edit($id)
    {
        $permissions = Permission::get();

        $role = Role::whereId($id)->with('permissions')->first();
        if (empty($role)) abort(404);

        $view = view('role.create', [
            'role' => $role,
            'role_permissions' => $role->permissions->pluck('id')->toArray(),
            'permissions' => $permissions,
        ]);

        return $view;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'permissions.required' => 'Please, select at least one permission.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors()->first());
        }

        $role = Role::whereId($id)->first();
        if (empty($role)) abort(404);

        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->intended(route('roles.index'))->with('success', 'Role has been updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::whereId($id)->first();
        if (empty($role)) abort(404);

        $user = User::whereHas('roles', function ($q) use ($id) {
            return $q->whereId($id);
        })->first();

        if (!empty($user)) {
            return response()->json(
                [
                    'message' => 'Unable to delete role which is assigned to a user.'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $role->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }

    public function datatable()
    {
        $roles = Role::get();

        $dt = DataTables::of($roles);

        $dt->addColumn('name', function ($record) {
            return '<a href="' . route('roles.edit', $record->id) . '">' . $record->name . '</a>';
        });

        $dt->addColumn('created_at', function ($record) {
            return $record->created_at;
        });

        $dt->addColumn('actions', function ($record) {
            return '<a href="' . route('roles.destroy', $record->id) . '" class="btn btn-sm btn-danger" delete-btn data-datatable="#roles-dt">
                        <span class="ni ni-trash"></span>
                    </a>

                    <a href="' . route('roles.edit', $record->id) . '" class="btn btn-sm btn-primary">
                        <span class="ni ni-edit"></span>
                    </a>';
        });

        $dt->rawColumns(['name', 'guard_name', 'created_at', 'actions']);
        $dt->addIndexColumn();

        return $dt->make(true);
    }
}
