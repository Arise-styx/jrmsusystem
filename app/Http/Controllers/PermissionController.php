<?php

namespace App\Http\Controllers;

use App\Models\PermissionExtend;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view permission', ['only' => ['index']]);
    //     $this->middleware('permission:create permission', ['only' => ['create','store']]);
    //     $this->middleware('permission:update permission', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $permissions = Permission::get();
        return view('roles-permissions.permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        $name = "Add Permission";
        return view('roles-permissions.permissions.create', compact('name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('/')->with('success','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        $name = "Edit Permission";
        return view('roles-permissions.permissions.edit', ['permission' => $permission, 'name' => $name]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('/')->with('updated','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        // $permission = Permission::find($permissionId);
        $permission = PermissionExtend::find($permissionId);
        $permission->delete();
        return redirect('/')->with('deleted','Permission Deleted Successfully');
    }
}
