<?php

namespace App\Http\Controllers;

use App\Mail\UserAccountInfo;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class AssignRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->where('role', 'admin')->get();

        return view('admin.assignrole.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.assignrole.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'permissionrole' => ['required', 'exists:roles,name']
        ]);

        $name = $request->name;
        $password = Str::random(10);
        $Hashpassword = Hash::make($password);
        $email = $request->email;
       

       $user = User::create([
            'name' => $request->name,
            'email' =>  $email,
            'phone' => $request->phone,
            'status' => 'active',
            'role' => 'admin',
            'password' => $Hashpassword
        ]);

        $user->assignRole($request->permissionrole);

        Mail::to($email)->send(new UserAccountInfo($name, $email, $password));

        return redirect()->route('users');
    }


    public function edit(string $id)
    {

        $roles = Role::all();
        $user = User::findOrFail($id);

        return view('admin.assignrole.edit', compact('roles', 'user'));
    }


    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //        'role' => ['required', 'exists:roles,name']
    //     ]);

    //     $user = User::findOrFail($id);

    //     $user->syncRoles([$request->role]);

    //     return redirect()->route('users');
    // }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,name']
        ]);

        $user = User::findOrFail($id);

        $user->syncRoles($request->roles);

        return redirect()->route('users')->with('success', 'Roles updated successfully');
    }



    public function destroy(string $id)
    {
        $role = User::findOrFail($id);
        $role->delete();
        return response()->json(['status' => 'success', 'message' => 'Role Permission Deleted Successfully']);
    }
}
