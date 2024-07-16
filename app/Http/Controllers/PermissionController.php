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

            'Dashboard',
            'Role Permission',
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
            'Profile',
        ];
        

        $groupby = [
            'Dashboard',
            'Role Permission',
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

            'Dashboard',
            'Role Permission',
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
            'Profile',
            

        ];

        $groupby = [
            'Dashboard',
            'Role Permission',
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
        $permission->delete();
        return redirect()->route('permissions');
    }
}
