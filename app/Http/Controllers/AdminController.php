<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function alluser()
    {
        $users = User::all();
        return view('admin.alluser', compact('users'));
    }

    public function project()
    {
        return view('admin.createproject');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'project'     => 'required|string|max:255',

        ]);

        $project = Project::create($data);

        return redirect()->route('admin.dashboard');
    }

    public function allproject()
    {
        $projects = Project::get();
        return view('admin.allprojects', compact('projects'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projectedit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($id);
        $project->project = $request->project;
        $project->save();

        return redirect()->route('admin.dashboard')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Project deleted successfully.');
    }


    //  project end here 
    public function task()
    {
        $tasks = Task::get();
        $projects = Project::get();
        return view('admin.createtask', compact('tasks', 'projects'));
    }

    public function alltask()
    {
        $tasks = Task::with('project')->latest()->get();
        return view('admin.alltasks', compact('tasks'));
    }
    public function storetask(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'project_id' => 'required',
        ]);

        $task = Task::create($data);

        return redirect()->route('admin.dashboard');
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.eidtTask', compact('task'));
    }

    public function updateTask(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Task::findOrFail($id)->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroyTask($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Task deleted successfully.');
    }

    public function assigne()
    {
        $projects = Project::with([
            'tasks' => fn($q) =>
            $q->whereDoesntHave('users')  
        ])->get();
        $users = User::get();
        return view('admin.taskassignment', compact('projects', 'users'));
    }


    public function attachtask(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'task_id'    => 'required|exists:tasks,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);
    
        $user = User::findOrFail($data['user_id']);

        $user->tasks()->attach($data['task_id'], [
            'project_id' => $data['project_id'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'],
        ]);

        return back()->with('success', 'Task assigned successfully.');
    }
        
    public function assigneall(){
        $assignedTasks = Task::with(['project', 'users'])->whereHas('users')->get();

        return view('admin.allassigne', compact('assignedTasks'));
    }

    public function editasigne($userId){
        $user = User::with(['tasks','tasks.project','tasks.users'])->findOrFail($userId);

        $projects = Project::with('tasks')->get();
        $users = User::orderBy('name')->get();
        return view('admin.editassigne',compact('projects','user','users'));
    }


public function updateAssignedTask(Request $request, $userId)
{
    $data = $request->validate([
        'user_id'    => 'required|exists:users,id',
        'project_id' => 'required|exists:projects,id',
        'task_id'    => 'required|exists:tasks,id',
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ]);

    // 1) Update the Task’s project_id
    $task = Task::findOrFail($data['task_id']);
    $task->project_id = $data['project_id'];
    $task->save();

    // 2) Check if the user is being changed
    if ($userId != $data['user_id']) {
        // Detach the task from the old user
        $oldUser = User::findOrFail($userId);
        $oldUser->tasks()->detach($data['task_id']);
    }

    // 3) Sync with the new user (from the request)
    $newUser = User::findOrFail($data['user_id']);
    $newUser->tasks()->sync([
        $data['task_id'] => [
            'project_id' => $data['project_id'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'],
        ]
    ], false); // Use `false` to avoid detaching other tasks

    return redirect()->route('assigne.all')
                     ->with('success','Assignment & project updated.');
}




}
