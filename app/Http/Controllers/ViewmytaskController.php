<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use Illuminate\Support\Facades\Auth;



class ViewmytaskController extends Controller
{
   
    public function edit(Request $request, $taskId)
    {
        $task = Task::find($taskId);
    
        // Pass the task data to the view
        return view('user.viewTask', ['task' => $task]);
    }
    
public function update(Request $request, $taskId)
{
    $request->validate([
        'status' => 'required|string', // Add any other validation rules as needed
    ]);

    $task = Task::find($taskId);
    if (!$task) {
        return redirect()->back()->with('error', 'Task not found.');
    }
    

    $task->update(['status' => $request->input('status')]);

    return redirect()->route('dashboard')->with('success', 'Status updated successfully.');
}


}
