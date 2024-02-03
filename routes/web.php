<?php

use App\Http\Controllers\AssigntaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewmytaskController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginForm'])->name('login.form');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks/{taskId}', [ViewmytaskController::class, 'edit'])->name('tasks.edit.user');
    Route::put('/tasks/{taskId}', [ViewmytaskController::class, 'update'])->name('tasks.update');
    Route::delete('/delete-task/{id}', [AssigntaskController::class, 'deleteTask']);
});


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/add_user', [AdminController::class, 'addUser'])->name('addUser');
    Route::post('/add_user', [AdminController::class, 'addUserForm'])->name('add.user');
    Route::get('/edit_user/{userId}', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('/edit_user/{userId}', [AdminController::class, 'editUserForm'])->name('edit.user');
    Route::post('/delete/user/{userId}', [AdminController::class, 'deleteUser'])->name('delete.user');
    Route::get('/assignTask/{assignId}', [AssigntaskController::class, 'assignTask'])->name('add.assignTask');
    Route::get('/assignTaskToMultiple', [TaskController::class, 'view'])->name('assignTask.multiple');
    // Route::post('/assignTaskToMultiple', [TaskController::class, 'store'])->name('assignTask.to.multiple');
    Route::post('/assign-task-to-multiple', [TaskController::class, 'storeMultiple'])->name('assignTask.to.multiple');

    Route::post('/submit-task', [AssigntaskController::class, 'store'])->name('submitTask');
    Route::get('/viewAssignedTask/{assignId}', [AssigntaskController::class, 'viewAssignedTask'])->name('view.assignTask');
    Route::get('/delete-task/{id}', [AssigntaskController::class, 'deleteTask']);
    Route::get('/tasks/{id}/edit', [AssigntaskController::class, 'edit'])->name('task.edit');
    Route::put('/update-task/{taskId}', [AssigntaskController::class, 'updateTask'])->name('update.task');
});





