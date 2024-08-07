<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view user', ['only' => ['index']]);
    //     $this->middleware('permission:create user', ['only' => ['create','store']]);
    //     $this->middleware('permission:update user', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete user', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $users = User::get();
        return view('roles-permissions.users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('roles-permissions.users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('success','User created successfully with roles');
    }

    public function edit(User $user)
    {
        $name = "Edit User";
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('roles-permissions.users.edit', compact('user', 'roles','userRoles', 'name'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'nullable|email|max:255',
            'roles' => 'required'
        ]);

        // $data = [
        //     'email' => $request->name,
        //     'roles' => $request->email,
        // ];

        // if(!empty($request->password)){
        //     $data += [
        //         'password' => Hash::make($request->password),
        //     ];
        // }
        if(!empty($request->email)) {
            User::find($user->id)->update([
                'email' => $request->email
            ]);


            $user->syncRoles($request->roles);
        }

        // $user->update($data);
        else {
            $user->syncRoles($request->roles);
        }

        // $user->syncRoles($request->roles);

        return redirect('/')->with('updated','User Updated Successfully with assign roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->employee) {
            $user->employee->user_id = null;
            $user->employee->save();
        }

        $user->delete();

        return redirect('/')->with('deleted','User Delete Successfully');
    }
}
