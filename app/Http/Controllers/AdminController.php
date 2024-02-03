<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addUser()
{
    $title = 'Add User';
    return view('add_user',['title' => $title]);
}

    public function addUserForm(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'nullable',
            'pincode' => 'nullable|numeric',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.unique' => 'email already exist.',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->pincode = $request->input('pincode');
        $user->password = bcrypt($request->input('password')); // Use bcrypt to securely hash the password

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User Added successfully!');

    }
    public function editUser($userId)
{
    $title = 'Edit User';
    $user = User::find($userId);
    return view('edit_user', ['userId' => $userId,'title'=>$title,'user'=>$user]);
}
public function editUserForm(Request $request, $userId)
{

    $request->validate([
        'name' => 'required',
        'email' => 'required|',
        'phone' => 'required|numeric',
        'address' => 'required',
        'pincode' => 'required|numeric',
    ]);

    $user = User::find($userId);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->pincode = $request->input('pincode');

    $user->save();

    return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');

}
public function deleteUser(Request $request, $userId)
{
    $user = User::find($userId);
    $user->update(['status' => 0]);

    return redirect()->route('admin.dashboard')->with('success', 'User Deactivated successfully!');
}
   
    
}
