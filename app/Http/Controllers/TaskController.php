<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;



class TaskController extends Controller
{
    public function view(){
        $title = 'Assign task to multiple user';
        $users = User::where('role', 2)->where('status',1)->get();   
        return view('assignTaskToMultiple',compact('users','title'));
    }
    // TaskController.php
public function storeMultiple(Request $request)
{
    $request->validate([
        'assigned_users' => 'required|array',
        'assigned_users.*' => 'exists:users,id',
        'title' => 'required',
        'description' => 'required',
        // 'status' => 'required',
    ]);

    // If you want to assign the task to multiple users
    $assignedUsers = $request->input('assigned_users', []);
    
    $task = new Task([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'assign_by' => $request->input('assign_by'),
    ]);

    auth()->user()->tasks()->save($task);

    // If you want to assign the task to multiple users
    $task->users()->attach($assignedUsers);

    return redirect()->route('admin.dashboard');
}

}
