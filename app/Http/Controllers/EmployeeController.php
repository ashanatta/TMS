<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function tasks(Request $request)
    {
        $user = $request->user(); // or auth()->user()

        // 2) eager‑load the related Task + Project if you want
        $tasks = $user->tasks()
            ->with('project')   // assuming Task `belongsTo Project`
            ->get();
        return view('employee.tasks', compact('tasks'));
    }

    public function show($id)
    {
        $user = auth()->user();

        // Get the task with pivot data and project relationship, only if it's assigned to this user
        $task = $user->tasks()->with('project')->where('tasks.id', $id)->firstOrFail();

        return view('employee.taskdetail', compact('task'));
    }

    public function setprofile()
    {
        $user = auth()->user();
        return view('employee.profile', compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required|image',
            'bio'  => 'nullable|string',
            'dob'  => 'required|date',
        ]);
    
        $user = auth()->user();
    
        // store the uploaded file
        $path = $request->file('image')->store('profile', 'public');
        
        // update *this* user
        $user->update([
            'name' => $request->name,
            'bio'  => $request->bio,
            'dob'  => $request->dob,
            'image'=> $path,
        ]);
    
        return back()->with('success', 'Profile updated successfully.');
    }
    

}
