<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['project', 'developer', 'tester', 'pm'])
                    ->latest()
                    ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $developers = User::where('role', 'developer')->get();
        $testers = User::where('role', 'tester')->get();
        $pms = User::where('role', 'pm')->get();

        return view('tasks.create', compact('projects', 'developers', 'testers', 'pms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'developer_id' => 'required',
            'tester_id' => 'required',
            'pm_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        $developers = User::where('role', 'developer')->get();
        $testers = User::where('role', 'tester')->get();
        $pms = User::where('role', 'pm')->get();

        return view('tasks.edit', compact('task', 'projects', 'developers', 'testers', 'pms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
              $request->validate([
            'project_id' => 'required',
            'developer_id' => 'nullable',
            'tester_id' => 'required',
            'pm_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $task = Task::findOrFail($id);
        
        // If developer is being reassigned and task was failed, reset status and failed attempts
        if ($request->developer_id != $task->developer_id && $task->status == 'failed') {
            $request->merge([
                'status' => 'pending',
                'failed_attempts' => 0,
            ]);
        }

        $task->update($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
}
