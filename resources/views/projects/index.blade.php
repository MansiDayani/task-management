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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        margin: 0 !important;
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

    .projects-table {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        overflow: hidden !important;
    }

    .projects-table table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    .projects-table thead {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
    }

    .projects-table th {
        padding: 1.5rem !important;
        color: #667eea !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-bottom: 2px solid rgba(102,126,234,0.15) !important;
    }

    .projects-table tbody tr {
        transition: all 0.2s ease !important;
        border-bottom: 1px solid rgba(102,126,234,0.08) !important;
    }

    .projects-table tbody tr:hover {
        background: rgba(102,126,234,0.04) !important;
    }

    .projects-table td {
        padding: 1.5rem !important;
        color: #1a1a1a !important;
    }

    .project-name {
        font-weight: 700 !important;
        color: #667eea !important;
        font-size: 1.05rem !important;
    }

    .creator-badge {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        display: inline-block !important;
    }

    .created-date {
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

        .projects-table th,
        .projects-table td {
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
        <h1>📁 Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <span>➕</span> Create Project
        </a>
    </div>

    <!-- Projects Table -->
    <div class="projects-table">
        @if($projects->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">No projects yet</div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Start by creating your first project to organize your team's work.</p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    <span>➕</span> Create Your First Project
                </a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>
                            <div class="project-name">{{ $project->name }}</div>
                        </td>
                        <td>
                            <div class="creator-badge">{{ $project->creator->name }}</div>
                        </td>
                        <td>
                            <div class="created-date">{{ $project->created_at->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
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
