<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        $permissions = Permission::get()->groupBy('groupby');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|min:3',
            // 'permission' => 'required'   
        ]);

        if ($validator->passes()) {

           $role = Role::create([
                'name' => $request->name
            ]);

            if (!empty($request->permission)) {
               foreach ($request->permission as $name) {
                $role->givePermissionTo($name);
               }
            }

            return redirect()->route('roles')->with('success', 'Role Created');

        }else{
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
       
    }

    public function edit(string $id){
        // Find the role by its ID
        $role = Role::findOrFail($id);
        
        // Get all permissions
        $permissions = Permission::get()->groupBy('groupby');
    
        // Get the role's permissions
        $rolePermissions = $role->permissions->pluck('name');
    
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    
    public function update(Request $request, $id){

        $role = Role::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->id),
                'min:3'
            ],
            // 'permission' => 'required|array',
            'permission.*' => 'exists:permissions,name'
        ]);
    
        if ($validator->passes()) {
            $role->update([
                'name' => $request->name
            ]);
    
            // Sync permissions
            $role->syncPermissions($request->permission);
    
            return redirect()->route('roles')->with('success', 'Role Updated');
        } else {
            return redirect()->route('roles.edit', $role->id)
                             ->withInput()
                             ->withErrors($validator);
        }
    }
    

    public function destroy(string $id){

        $role = Role::findOrFail($id);

        // Check if the role is assigned to any users
        if ($role->users()->count() > 0) {
            return response()->json(['status' => 'error', 'message' => 'You cannot delete this role because it is assigned to users.']);
        }
    
        $role->delete();
    
        return response()->json(['status' => 'success', 'message' => 'Role deleted successfully.']);

    }
}
