@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <style>
        .project-header {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%);
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .project-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .stat-item {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8f9ff 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #667eea;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        .task-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }
        .task-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.15);
        }
        .task-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }
        .task-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.9rem;
            color: #6c757d;
            flex-wrap: wrap;
        }
        .badge-status {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .badge-pending {
            background: #ffeaa7;
            color: #d63031;
        }
        .badge-in-progress {
            background: #74b9ff;
            color: #0984e3;
        }
        .badge-completed {
            background: #55efc4;
            color: #00b894;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }
    </style>

    <div class="project-header">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <h1 class="project-title">{{ $project->name }}</h1>
                <p style="color: #6c757d; font-size: 1rem; margin: 0;">
                    Created by <strong style="color: #667eea;">{{ $project->creator->name }}</strong> on 
                    <strong>{{ $project->created_at->format('M d, Y') }}</strong>
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-primary">Edit</a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project and all its tasks?')">Delete</button>
                </form>
            </div>
        </div>

        @if($project->description)
            <p style="color: #6c757d; margin-top: 1.5rem; font-size: 1rem;">
                {{ $project->description }}
            </p>
        @endif

        <div class="stats-row">
            <div class="stat-item">
                <div class="stat-value">{{ $taskStats['total'] }}</div>
                <div class="stat-label">Total Tasks</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" style="color: #00b894;">{{ $taskStats['completed'] }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" style="color: #0984e3;">{{ $taskStats['in_progress'] }}</div>
                <div class="stat-label">In Progress</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" style="color: #d63031;">{{ $taskStats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Project Tasks
        </div>
        <div class="card-body">
            @if($project->tasks->isEmpty())
                <div class="empty-state">
                    <p style="font-size: 1.1rem; margin-bottom: 1rem;">📋 No tasks created yet</p>
                    <p style="font-size: 0.95rem;">Create your first task to get started.</p>
                    <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-primary mt-3">Create Task</a>
                </div>
            @else
                @foreach($project->tasks as $task)
                    <div class="task-card">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <div class="task-title">{{ $task->title }}</div>
                                <div class="task-meta">
                                    <span>👤 Developer: <strong>{{ $task->developer?->name ?? 'Unassigned' }}</strong></span>
                                    <span>🧪 Tester: <strong>{{ $task->tester?->name ?? 'Unassigned' }}</strong></span>
                                    <span>📅 Deadline: <strong>{{ $task->deadline?->format('M d, Y') ?? 'No deadline' }}</strong></span>
                                </div>
                            </div>
                            <span class="badge-status badge-{{ str_replace('_', '-', $task->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                        @if($task->description)
                            <p style="color: #6c757d; margin-top: 1rem; font-size: 0.95rem;">
                                {{ Str::limit($task->description, 150) }}
                            </p>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div style="margin-top: 2rem;">
        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">← Back to Projects</a>
    </div>
</div>
@endsection
