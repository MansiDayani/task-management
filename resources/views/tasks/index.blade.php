@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
    }

    .container-fluid {
        max-width: 1400px !important;
        margin: 0 auto !important;
        padding: 3rem 2rem !important;
        background: transparent !important;
    }

    .page-header {
        background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%) !important;
        border-radius: 24px !important;
        padding: 2.5rem !important;
        margin-bottom: 2.5rem !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }

    .page-header h1 {
        font-size: 2.5rem !important;
        font-weight: 800 !important;
        color: #667eea !important;
        margin: 0 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }

    .btn {
        padding: 0.875rem 2rem !important;
        font-weight: 700 !important;
        border: none !important;
        border-radius: 12px !important;
        font-size: 1rem !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        min-height: 44px !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        box-shadow: 0 8px 25px rgba(102,126,234,0.3) !important;
    }

    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 35px rgba(102,126,234,0.4) !important;
    }

    .tasks-table {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        overflow: hidden !important;
    }

    .tasks-table table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    .tasks-table thead {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
    }

    .tasks-table th {
        padding: 1.5rem !important;
        color: #667eea !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-bottom: 2px solid rgba(102,126,234,0.15) !important;
    }

    .tasks-table tbody tr {
        transition: all 0.2s ease !important;
        border-bottom: 1px solid rgba(102,126,234,0.08) !important;
    }

    .tasks-table tbody tr:hover {
        background: rgba(102,126,234,0.04) !important;
    }

    .tasks-table td {
        padding: 1.5rem !important;
        color: #1a1a1a !important;
    }

    .task-title {
        font-weight: 700 !important;
        color: #667eea !important;
        font-size: 1.05rem !important;
    }

    .status-badge {
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        display: inline-block !important;
        text-transform: capitalize !important;
    }

    .status-badge.pending {
        background: rgba(255,193,7,0.1) !important;
        color: #ffc107 !important;
    }

    .status-badge.submitted {
        background: rgba(0,123,255,0.1) !important;
        color: #007bff !important;
    }

    .status-badge.testing {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
    }

    .status-badge.pm_review {
        background: rgba(255,152,0,0.1) !important;
        color: #ff9800 !important;
    }

    .status-badge.final_completed {
        background: rgba(40,167,69,0.1) !important;
        color: #28a745 !important;
    }

    .status-badge.failed {
        background: rgba(220,53,69,0.1) !important;
        color: #dc3545 !important;
    }

    .user-badge {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        display: inline-block !important;
        font-size: 0.9rem !important;
    }

    .deadline-date {
        color: #6c757d !important;
        font-weight: 500 !important;
    }

    .action-buttons {
        display: flex !important;
        gap: 0.75rem !important;
        justify-content: flex-end !important;
    }

    .btn-sm {
        padding: 0.6rem 1.2rem !important;
        font-size: 0.9rem !important;
        min-height: 36px !important;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        border: none !important;
    }

    .btn-edit:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.2) !important;
    }

    .btn-delete {
        background: rgba(220,53,69,0.1) !important;
        color: #dc3545 !important;
        border: 2px solid rgba(220,53,69,0.2) !important;
    }

    .btn-delete:hover {
        background: #dc3545 !important;
        color: white !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(220,53,69,0.2) !important;
    }

    .empty-state {
        text-align: center !important;
        padding: 3rem 2rem !important;
        color: #6c757d !important;
    }

    .empty-state-icon {
        font-size: 3rem !important;
        margin-bottom: 1rem !important;
    }

    .empty-state-text {
        font-size: 1.1rem !important;
        margin-bottom: 1.5rem !important;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column !important;
            gap: 1.5rem !important;
            text-align: center !important;
        }

        .page-header h1 {
            font-size: 1.75rem !important;
        }

        .tasks-table th,
        .tasks-table td {
            padding: 1rem !important;
            font-size: 0.9rem !important;
        }

        .action-buttons {
            flex-direction: column !important;
        }

        .btn-sm {
            width: 100% !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>📋 Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <span>➕</span> Create Task
        </a>
    </div>

    <!-- Tasks Table -->
    <div class="tasks-table">
        @if($tasks->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">No tasks yet</div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Start by creating your first task to assign work to your team members.</p>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <span>➕</span> Create Your First Task
                </a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Developer</th>
                        <th>Tester</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>
                            <div class="task-title">{{ $task->title }}</div>
                        </td>
                        <td>
                            <div class="user-badge">{{ $task->project->name ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="user-badge">{{ $task->developer->name ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="user-badge">{{ $task->tester->name ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="status-badge {{ str_replace('_', '-', $task->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="deadline-date">
                                @if($task->deadline)
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                @else
                                    <span style="color: #dc3545;">Not set</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
