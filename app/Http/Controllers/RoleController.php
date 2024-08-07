<?php

namespace App\Http\Controllers;

use App\Models\RoleExtend;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view role', ['only' => ['index']]);
    //     $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
    //     $this->middleware('permission:update role', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete role', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $roles = Role::get();
        return view('roles-permissions.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $name = "Add Role";
        return view('roles-permissions.roles.create', compact('name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('/')->with('success','Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $name = "Edit Role";
        return view('roles-permissions.roles.edit',[
            'role' => $role,
            'name' => $name

        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('/')->with('updated','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        // $role = Role::find($roleId);
        $role = RoleExtend::find($roleId);
        $role->delete();
        return redirect('/')->with('deleted','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $name = "Add Permissions to Role";
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('roles-permissions.roles.add_permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
            'name' => $name
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect('/')->with('success','Permissions added to role');
    }
}
