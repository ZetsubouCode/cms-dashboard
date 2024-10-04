<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public $menuName = "Role Permission";
    public function view(){
        $data = Role::all();
        $breadcrumbs = [
            ['url' => route('rolepermission.view'), 'label' => 'Role'],
            ['url' => route('rolepermission.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.rolepermission.rolepermission-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function addPermission(){
        $data = Role::all();
        $breadcrumbs = [
            ['url' => route('rolepermission.view'), 'label' => 'Role'],
            ['url' => route('rolepermission.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.rolepermission.rolepermission-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }
    public function addRole(){
        $data = Role::all();
        $breadcrumbs = [
            ['url' => route('rolepermission.view'), 'label' => 'Role'],
            ['url' => route('rolepermission.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.rolepermission.rolepermission-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function updateRolePermission(Request $request)
    {
        // Example validation
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'required|string|max:100',
            'address' => 'nullable|string|max:2000',
            'phone_number' => 'nullable|string|max:2000',
        ]);

        // Example of adding data to the database
        Role::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('role.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data role added successfully!'
            ]);
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $role->delete();
        
        return redirect()->route('role.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method deleted successfully!'
            ]);
    }

    public function deletePermission($id)
    {
        $role = Role::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $role->delete();
        
        return redirect()->route('role.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method deleted successfully!'
            ]);
    }
}
