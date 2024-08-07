<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('groupby', 'ASC')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {

        $permissions = [

            'View Dashboard',

            'View Permission',
            'Create Permission',
            'Edit Permission',
            'Delete Permission',

            "View Role",
            'Create Role',
            'Edit Role',
            'Delete Role',

            'View AssignRole',
            'Create AssignRole',
            'Edit AssignRole',
            'Delete AssignRole',

            'View Category',
            'Create Category',
            'Edit Category',
            'Delete Category',

            'View Author',
            'Create Author',
            'Edit Author',
            'Delete Author',

            'View Publisher',
            'Create Publisher',
            'Edit Publisher',
            'Delete Publisher',

            'View Book',
            'Create Book',
            'Edit Book',
            'Delete Book',

            'Online Book Borrow',
            'Offline Book Borrow',
            'Report',
            'Review',
            'Message',
            'Policy',
            'User',
            'Profile',
        ];


        $groupby = [
            'Dashboard',
            'Permission',
            'Role',
            'AssignRole',
            'Category',
            'Author',
            'Publisher',
            'Book',
            'Online Book Borrow',
            'Offline Book Borrow',
            'Report',
            'Review',
            'Message',
            'Policy',
            'User',
            'Profile'
        ];

        return view('admin.permissions.create', compact('permissions', 'groupby'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name|min:3',
            'groupby' => 'required'
        ]);


        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name,
                'groupby' => $request->groupby
            ]);

            return redirect()->route('permissions')->with('success', 'Permission Create');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    public function edit(string $id)
    {

       
        $permissions = [

            'View Dashboard',

            'View Permission',
            'Create Permission',
            'Edit Permission',
            'Delete Permission',

            "View Role",
            'Create Role',
            'Edit Role',
            'Delete Role',

            'View AssignRole',
            'Create AssignRole',
            'Edit AssignRole',
            'Delete AssignRole',

            'View Category',
            'Create Category',
            'Edit Category',
            'Delete Category',

            'View Author',
            'Create Author',
            'Edit Author',
            'Delete Author',

            'View Publisher',
            'Create Publisher',
            'Edit Publisher',
            'Delete Publisher',

            'View Book',
            'Create Book',
            'Edit Book',
            'Delete Book',

            'Online Book Borrow',
            'Offline Book Borrow',
            'Report',
            'Review',
            'Message',
            'Policy',
            'User',
            'Profile',
        ];


        $groupby = [
            'Dashboard',
            'Permission',
            'Role',
            'AssignRole',
            'Category',
            'Author',
            'Publisher',
            'Book',
            'Online Book Borrow',
            'Offline Book Borrow',
            'Report',
            'Review',
            'Message',
            'Policy',
            'User',
            'Profile'
        ];

        $permissionId = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permissions', 'permissionId', 'groupby'));
    }



    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($id)
            ],

            'groupby' => 'required'
        ]);


        if ($validator->passes()) {
            Permission::findOrFail($id)->update([
                'name' => $request->name,
                'groupby' => $request->groupby
            ]);

            return redirect()->route('permissions')->with('success', 'Permission Updated');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        if (count($permission->roles) > 0) {
            return response()->json(['status' => 'error', 'message' => 'You Cant delete this! It has Roles']);

        }

        $permission->delete();
        return response()->json(['status' => 'success', 'message' => 'Permission Deleted Successfully']);
    }
}
