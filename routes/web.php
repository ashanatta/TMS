<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttandanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home');



// Login / Logout
Route::get('login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');
        Route::get('register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::get   ('/users/{id}/edit',[AuthController::class,'edit'])->   name('users.edit');
        Route::put   ('/users/{id}'      ,[AuthController::class,'update'])-> name('users.update');
        Route::delete('/users/{id}'      ,[AuthController::class,'destroy'])->name('users.destroy');
        //email 

        Route::get('all`1user', [AdminController::class, 'alluser'])->name('alluser');
        Route::get('project-create', [AdminController::class, 'project'])->name('project.create');
        Route::post('project-store', [AdminController::class, 'store'])->name('project.store');
        Route::get('all-projects', [AdminController::class, 'allproject'])->name('project.all');
        Route::get('/projects/{id}/edit', [AdminController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{id}', [AdminController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{id}', [AdminController::class, 'destroy'])->name('projects.destroy');

        Route::get('task-create', [AdminController::class, 'task'])->name('task.create');
        Route::post('task-store', [AdminController::class, 'storetask'])->name('task.store');
        Route::get('all-tasks', [AdminController::class, 'alltask'])->name('task.all');
        Route::get('/tasks/{id}/edit', [AdminController::class, 'editTask'])->name('tasks.edit');
        Route::put('/tasks/{id}', [AdminController::class, 'updateTask'])->name('tasks.update');
        Route::delete('/tasks/{id}', [AdminController::class, 'destroyTask'])->name('tasks.destroy');

        Route::get('assigne-task', [AdminController::class, 'assigne'])->name('task.assigne');
        Route::post('task-attach', [AdminController::class, 'attachtask'])->name('attach.task');
        Route::get('assigne-all', [AdminController::class, 'assigneall'])->name('assigne.all');
        Route::get('/assigne/{id}/edit', [AdminController::class, 'editasigne'])->name('assigne.edit');
        Route::post('/assigne/{user}/update', [AdminController::class, 'updateAssignedTask'])->name('update.task');
            
    });

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->group(function () {
        Route::view('dashboard', 'employee.dashboard')->name('employee.dashboard');
        Route::get('tasks',[EmployeeController::class,'tasks'])->name('employee.tasks');
        Route::get('/task/{id}/info', [EmployeeController::class, 'show'])->name('tasks.info');

    });

    Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->group(function () {
        Route::view('dashboard', 'manager.dashboard')->name('manger.dashboard');
        // Route::get('alluser', [AdminController::class, 'alluser'])->name('alluser');
        //  Route::get('all-projects', [AdminController::class, 'allproject'])->name('project.all');
        // Route::get('all-tasks', [AdminController::class, 'alltask'])->name('task.all');
        // Route::get('assigne-all', [AdminController::class, 'assigneall'])->name('assigne.all');

    });