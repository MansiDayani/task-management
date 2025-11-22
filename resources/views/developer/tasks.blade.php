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
        margin: 0 0 0.5rem 0 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }

    .page-header p {
        color: #6c757d !important;
        font-size: 1rem !important;
        margin: 0 !important;
    }

    .points-display {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
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

    .btn-secondary {
        background: #f0f2f5 !important;
        color: #667eea !important;
        border: 2px solid rgba(102,126,234,0.2) !important;
    }

    .btn-secondary:hover {
        background: #e8ecf1 !important;
        border-color: #667eea !important;
        transform: translateY(-2px) !important;
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

    .project-badge {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        display: inline-block !important;
        font-size: 0.9rem !important;
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

    .deadline-date {
        color: #6c757d !important;
        font-weight: 500 !important;
    }

    .attempts-badge {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        display: inline-block !important;
    }

    .action-buttons {
        display: flex !important;
        gap: 0.75rem !important;
        justify-content: center !important;
    }

    .btn-sm {
        padding: 0.6rem 1.2rem !important;
        font-size: 0.9rem !important;
        min-height: 36px !important;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        border: none !important;
    }

    .btn-submit:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.2) !important;
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

    /* Modal Styles */
    .modal-overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        background: rgba(0,0,0,0.5) !important;
        backdrop-filter: blur(4px) !important;
        display: none !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 1000 !important;
    }

    .modal-overlay.show {
        display: flex !important;
    }

    .modal-content {
        background: white !important;
        border-radius: 24px !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3) !important;
        max-width: 600px !important;
        width: 90% !important;
        max-height: 90vh !important;
        overflow-y: auto !important;
        padding: 2.5rem !important;
    }

    .modal-header {
        margin-bottom: 2rem !important;
    }

    .modal-header h2 {
        font-size: 2rem !important;
        font-weight: 800 !important;
        color: #667eea !important;
        margin: 0 !important;
    }

    .form-group {
        margin-bottom: 1.5rem !important;
    }

    .form-label {
        display: block !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 0.75rem !important;
        font-size: 0.95rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    .form-control {
        width: 100% !important;
        padding: 0.875rem 1.25rem !important;
        border: 2px solid rgba(102,126,234,0.15) !important;
        border-radius: 12px !important;
        font-size: 1rem !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        transition: all 0.3s ease !important;
        background: white !important;
        color: #1a1a1a !important;
    }

    .form-control:focus {
        outline: none !important;
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.1) !important;
    }

    textarea.form-control {
        resize: vertical !important;
        min-height: 150px !important;
    }

    .form-helper {
        font-size: 0.85rem !important;
        color: #6c757d !important;
        margin-top: 0.5rem !important;
    }

    .modal-actions {
        display: flex !important;
        gap: 1rem !important;
        margin-top: 2rem !important;
        padding-top: 1.5rem !important;
        border-top: 1px solid rgba(102,126,234,0.1) !important;
    }

    .btn-cancel {
        background: #f0f2f5 !important;
        color: #667eea !important;
        border: 2px solid rgba(102,126,234,0.2) !important;
    }

    .btn-cancel:hover {
        background: #e8ecf1 !important;
        border-color: #667eea !important;
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

        .modal-content {
            padding: 1.5rem !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>📋 My Tasks</h1>
            <p>Total Points: <span class="points-display">{{ $totalPoints }}</span></p>
        </div>
        <a href="{{ route('developer.dashboard') }}" class="btn btn-secondary">
            ← Dashboard
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div style="background: rgba(40,167,69,0.1); border: 2px solid #28a745; color: #155724; padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">✓</span>
            <div style="flex: 1;">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div style="background: rgba(220,53,69,0.1); border: 2px solid #dc3545; color: #721c24; padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">✗</span>
            <div style="flex: 1;">{{ session('error') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div style="background: rgba(220,53,69,0.1); border: 2px solid #dc3545; color: #721c24; padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem;">
            <div style="font-weight: 700; margin-bottom: 0.5rem;">Please fix the following errors:</div>
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tasks Table -->
    <div class="tasks-table">
        @if($tasks->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">No tasks assigned yet</div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">You don't have any tasks assigned to you at the moment.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Attempts</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>
                            <div class="task-title">{{ $task->title }}</div>
                        </td>
                        <td>
                            <div class="project-badge">{{ $task->project->name ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="status-badge {{ str_replace('_', '-', $task->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="deadline-date">
                                @if($task->deadline)
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                @else
                                    <span style="color: #dc3545;">Not set</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="attempts-badge">{{ $task->attempts->count() }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if($task->status == 'pending' || $task->status == 'failed')
                                    <button onclick="openSubmitModal({{ $task->id }}, '{{ addslashes($task->title) }}')" class="btn btn-sm btn-submit">
                                        📤 Submit Task
                                    </button>
                                @else
                                    <span style="color: #6c757d; font-weight: 600;">Submitted</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<!-- Submit Task Modal -->
<div id="submitModal" class="modal-overlay" onclick="if(event.target === this) closeSubmitModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Submit Task: <span id="taskTitle"></span></h2>
        </div>
        
        <form id="submitForm" method="POST" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
                <div style="background: rgba(220,53,69,0.1); border: 2px solid #dc3545; color: #721c24; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                    <div style="font-weight: 700; margin-bottom: 0.5rem;">Validation Errors:</div>
                    <ul style="margin: 0; padding-left: 1.5rem; font-size: 0.9rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label class="form-label">
                    Submission Notes
                    <span style="color: #dc3545;">*</span>
                </label>
                <textarea name="submission_notes" rows="6" required
                    class="form-control"
                    placeholder="Describe your work, what you've implemented, any challenges faced..."></textarea>
                <div class="form-helper">Provide detailed information about your submission</div>
            </div>

            <div class="form-group">
                <label class="form-label">Upload File (Optional)</label>
                <input type="file" name="file" class="form-control">
                <div class="form-helper">Maximum file size: 10MB</div>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    ✓ Submit Task
                </button>
                <button type="button" onclick="closeSubmitModal()" class="btn btn-cancel">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openSubmitModal(taskId, taskTitle) {
    document.getElementById('taskTitle').textContent = taskTitle;
    document.getElementById('submitForm').action = `/developer/task/${taskId}/submit`;
    document.getElementById('submitModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeSubmitModal() {
    document.getElementById('submitModal').classList.remove('show');
    document.getElementById('submitForm').reset();
    document.body.style.overflow = '';
}
</script>
@endsection
