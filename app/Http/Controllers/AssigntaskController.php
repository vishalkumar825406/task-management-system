<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AssigntaskController extends Controller
{

    public function assignTask($assignId)
    {
        $title = 'Assign Task';
        return view('assignTask', ['assignId' => $assignId,'title'=>$title]);
    }

 

public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'userId' => 'required', 
        'title' => 'required',
        'description' => 'required',
        'assign_by' => 'required',
    ]);

    // Create a new task instance
    $task = new Task([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);

    auth()->user()->tasks()->save($task);

    $task->users()->attach($request->input('userId'));

    $task->assign_by = $request->input('assign_by');
    $task->save();

    return redirect()->route('admin.dashboard')->with('success', 'Task added successfully');
}

    public function viewAssignedTask(Request $request, $assignId)
{
    // $search = $request->input('search', '');

    // if ($search !== '') {
    //     $tasks = Task::where('status', 'LIKE', '%' . $search . '%')->paginate(5);
    //     $title = 'Assigned Tasks';
    // } else {
    //     $tasks = DB::table('tasks')
    //         ->where('user_id', $assignId)
    //         ->where('isActive', 1);
    //         $title = 'Assigned Tasks';
    // }
    $tasks = Task::join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $assignId)
            ->where('tasks.isActive', 1)
            ->select('tasks.*')
            ->paginate(5);
            // return $tasks;

$title = 'Assigned Tasks';


    return view('viewAssignedTask', ['tasks' => $tasks,'title' => $title]);
}
    public function deleteTask($taskId)
{
    $task = Task::find($taskId);

    if ($task) {
        $task->update(['isActive' => 0]);       
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

}
public function edit($taskId)
{
    $title = 'Update Task';
    $task = Task::find($taskId);

    if (!$task) {
        return redirect()->with('error', 'Task not found.');
    }

    return view('updateAssignTask', ['task' => $task,'title'=>$title]);
}

public function updateTask(Request $request, $taskId)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:Incomplete,completed', 
    ]);

    $task = Task::find($taskId);
    if (!$task) {
        return redirect()->back()->with('error', 'Task not found.');
    }
    $user_id = $request->input('user_id');
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->status = $request->input('status');

    // Save the updated task
   $done = $task->save();
    if($done){
        // return redirect()->route('view.assignTask')->with('success', 'Task updated successfully.');
        // return redirect()->route('view.assignTask', ['assignId' => $taskId])->with('success', 'Task updated successfully.');

    return redirect()->route('admin.dashboard')->with('success', 'Task updated successfully.');

    }

}
}
