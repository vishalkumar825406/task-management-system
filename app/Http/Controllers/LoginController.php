<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task; 


class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginForm(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Authentication successful

        // Get the authenticated user
        $user = Auth::user();

        // Check the user's role and redirect accordingly
        if ($user->role === '1') {
            // Admin authenticated, redirect to admin dashboard
            return redirect()->intended('/admin/dashboard');
        }

        // Regular user authenticated, redirect to user dashboard
        return redirect()->intended('/dashboard');
    }

    // Authentication failed, handle errors

    $errorMessages = [];

    // Check if the email is incorrect
    if (!User::where('email', $credentials['email'])->exists()) {
        $errorMessages['email'] = 'Invalid email';
    }

    // Check if the password is incorrect
    if (!Auth::validate($credentials)) {
        $errorMessages['password'] = 'Invalid password';
    }

    return redirect()->route('login')->withErrors($errorMessages);
}

    // public function loginForm(Request $request)
    // {
    //     $credentials = $request->only('email', 'password','role');
    //     if (Auth::attempt($credentials)) {
    //         if ($credentials['role'] === '1') {
    //             $isAdmin = true;
    //             return redirect()->intended('/admin/dashboard');
    //         }
    
    //         return redirect()->intended('/dashboard');
    //     }
    
    //     $errorMessages = [];
    
    //     // Check if the email is incorrect
    //     if (!User::where('email', $credentials['email'])->exists()) {
    //         $errorMessages['email'] = 'Invalid email';
    //     }
    
    //     // Check if the password is incorrect
    //     if (!Auth::validate($credentials)) {
    //         $errorMessages['password'] = 'Invalid password';
    //     }
    
    //     return redirect()->route('login')->withErrors($errorMessages);
    // }

    public function adminDashboard(){    
        $usersWithRoleTwos = User::where('role', 2)->where('status',1)->get();   
        return view('admin.dashboard',compact('usersWithRoleTwos'));
    }
    public function dashboard(Request $request){
        $userId = Auth::user()->id;

        $tasks = Task::join('task_user', 'tasks.id', '=', 'task_user.task_id')
        ->where('task_user.user_id', $userId)
        ->where('tasks.isActive', 1)
        ->select('tasks.*')
        ->paginate(5);

    
        return view('user.dashboard', compact('tasks'));
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
