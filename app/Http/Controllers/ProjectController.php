<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Protect all routes - user must be authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of all projects (index view)
     * Flow: Fetch all projects with creator info and pass to view
     */
    public function index()
    {
        // Fetch all projects with creator relationship, ordered by latest first
        $projects = Project::with('creator')
            ->withCount('tasks')  // Add task count for each project
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project
     * Flow: Display empty create form to user
     */
    public function create()
    {
        // Check if user has permission to create projects (admin/pm)
        if (!in_array(Auth::user()->role, ['admin', 'pm'])) {
            return redirect()->route('projects.index')
                ->with('error', 'You do not have permission to create projects.');
        }

        return view('projects.create');
    }

    /**
     * Store a newly created project in the database
     * Flow: Validate input → Create project → Redirect with success message
     */
    public function store(Request $request)
    {
        // Check authorization
        if (!in_array(Auth::user()->role, ['admin', 'pm'])) {
            return redirect()->route('projects.index')
                ->with('error', 'You do not have permission to create projects.');
        }

        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:projects,name',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Project name is required.',
            'name.unique' => 'A project with this name already exists.',
            'description.max' => 'Description cannot exceed 1000 characters.',
        ]);

        // Create new project with validated data
        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'created_by' => Auth::id(),
        ]);

        // Redirect back to projects list with success message
        return redirect()->route('projects.index')
            ->with('success', "Project '{$project->name}' created successfully!");
    }

    /**
     * Display a specific project with all its tasks
     * Flow: Find project → Fetch related tasks → Display details
     */
    public function show(Project $project)
    {
        // Eager load tasks with developer and tester info
        $project->load('tasks.developer', 'tasks.tester');

        // Get task statistics for this project
        $taskStats = [
            'total' => $project->tasks()->count(),
            'completed' => $project->tasks()->where('status', 'completed')->count(),
            'in_progress' => $project->tasks()->where('status', 'in_progress')->count(),
            'pending' => $project->tasks()->where('status', 'pending')->count(),
        ];

        return view('projects.show', compact('project', 'taskStats'));
    }

    /**
     * Show the form for editing a specific project
     * Flow: Find project → Check authorization → Display edit form
     */
    public function edit(Project $project)
    {
        // Check if user is authorized to edit this project
        // Only creator, admin can edit
        if ($project->created_by !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')
                ->with('error', 'You are not authorized to edit this project.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update a project in the database
     * Flow: Find project → Validate input → Update → Redirect with success
     */
    public function update(Request $request, Project $project)
    {
        // Authorization check
        if ($project->created_by !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')
                ->with('error', 'You are not authorized to update this project.');
        }

        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $project->id,
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Project name is required.',
            'name.unique' => 'A project with this name already exists.',
            'description.max' => 'Description cannot exceed 1000 characters.',
        ]);

        // Update project with new data
        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        // Redirect with success message
        return redirect()->route('projects.index')
            ->with('success', "Project '{$project->name}' updated successfully!");
    }

    /**
     * Delete a project from the database
     * Flow: Find project → Check authorization → Delete related tasks → Delete project
     */
    public function destroy(Project $project)
    {
        // Authorization check
        if ($project->created_by !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')
                ->with('error', 'You are not authorized to delete this project.');
        }

        $projectName = $project->name;

        // Delete all related tasks first (cascade delete)
        $project->tasks()->delete();

        // Delete the project
        $project->delete();

        // Redirect with success message
        return redirect()->route('projects.index')
            ->with('success', "Project '{$projectName}' and all its tasks have been deleted.");
    }
}
