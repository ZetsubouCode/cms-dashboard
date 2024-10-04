<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $menuName = "User";
    public function view(){
        $data = User::all();
        $breadcrumbs = [
            ['url' => route('user.view'), 'label' => 'User'],
            ['url' => route('user.view', ['id' => 1]), 'label' => 'View']
        ];
        return view('dashboard.user.user-view', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function add(){
        $data = User::all();
        $breadcrumbs = [
            ['url' => route('user.view'), 'label' => 'User'],
            ['url' => route('user.add', ['id' => 1]), 'label' => 'Add']
        ];
        return view('dashboard.user.user-add', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function create(Request $request)
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
        User::create($validated);
        // Pass the message back to the view (using session flash data)
        return redirect()->route('user.add')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Data user added successfully!'
            ]);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $breadcrumbs = [
            ['url' => route('user.view'), 'label' => 'User'],
            ['url' => route('user.edit', ['id' => $id]), 'label' => 'Edit']
        ];
        return view('dashboard.user.user-edit', ['data'=>$data,'breadcrumbs'=>$breadcrumbs,'menuName'=>$this->menuName]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:AVAILABLE,NOT AVAILABLE',
        ]);

        $user->update($validated);

        return redirect()->route('user.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method updated successfully!'
            ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        
        // Optionally check for constraints, relationships, etc.
        $user->delete();
        
        return redirect()->route('user.view')
            ->with('messageAlert', [
                'type' => 'success',
                'message' => 'Payment method deleted successfully!'
            ]);
    }
}
