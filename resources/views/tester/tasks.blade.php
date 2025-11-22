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

    .btn-secondary {
        background: #f0f2f5 !important;
        color: #667eea !important;
        border: 2px solid rgba(102,126,234,0.2) !important;
    }

    .btn-secondary:hover {
        background: #e8ecf1 !important;
        border-color: #667eea !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.15) !important;
    }

    .task-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        padding: 2rem !important;
        margin-bottom: 1.5rem !important;
        transition: all 0.3s ease !important;
    }

    .task-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 45px rgba(102,126,234,0.15) !important;
    }

    .task-header {
        display: flex !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
        margin-bottom: 1.5rem !important;
        padding-bottom: 1.5rem !important;
        border-bottom: 2px solid rgba(102,126,234,0.1) !important;
    }

    .task-title {
        font-size: 1.75rem !important;
        font-weight: 800 !important;
        color: #1a1a1a !important;
        margin-bottom: 0.75rem !important;
    }

    .task-info {
        color: #6c757d !important;
        font-size: 0.95rem !important;
        margin-bottom: 0.5rem !important;
    }

    .task-info strong {
        color: #667eea !important;
        font-weight: 600 !important;
    }

    .status-badge {
        padding: 0.75rem 1.5rem !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        text-transform: capitalize !important;
    }

    .status-badge.submitted {
        background: rgba(0,123,255,0.1) !important;
        color: #007bff !important;
    }

    .status-badge.testing {
        background: rgba(102,126,234,0.1) !important;
        color: #667eea !important;
    }

    .attempt-box {
        background: linear-gradient(135deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%) !important;
        border: 2px solid rgba(102,126,234,0.15) !important;
        border-radius: 16px !important;
        padding: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .attempt-header {
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 1rem !important;
    }

    .attempt-notes {
        color: #1a1a1a !important;
        font-size: 1rem !important;
        line-height: 1.6 !important;
        margin-bottom: 1rem !important;
        padding: 1rem !important;
        background: white !important;
        border-radius: 8px !important;
        border-left: 4px solid #667eea !important;
    }

    .file-link {
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        color: #007bff !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        padding: 0.5rem 1rem !important;
        background: rgba(0,123,255,0.1) !important;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }

    .file-link:hover {
        background: rgba(0,123,255,0.2) !important;
        transform: translateY(-2px) !important;
    }

    .attempt-meta {
        color: #6c757d !important;
        font-size: 0.85rem !important;
        margin-top: 1rem !important;
        padding-top: 1rem !important;
        border-top: 1px solid rgba(102,126,234,0.1) !important;
    }

    .btn-review {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        color: white !important;
        padding: 0.875rem 2rem !important;
        font-weight: 700 !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 25px rgba(0,123,255,0.3) !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    .btn-review:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 35px rgba(0,123,255,0.4) !important;
    }

    .reviewed-badge {
        color: #28a745 !important;
        font-weight: 700 !important;
        font-size: 1rem !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        padding: 0.75rem 1.5rem !important;
        background: rgba(40,167,69,0.1) !important;
        border-radius: 12px !important;
    }

    .empty-state {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        padding: 4rem 2rem !important;
        text-align: center !important;
    }

    .empty-state-icon {
        font-size: 4rem !important;
        margin-bottom: 1.5rem !important;
    }

    .empty-state-text {
        font-size: 1.25rem !important;
        color: #6c757d !important;
        font-weight: 600 !important;
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
        max-width: 700px !important;
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
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
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

    .radio-option {
        display: flex !important;
        align-items: center !important;
        padding: 1.25rem !important;
        border: 2px solid rgba(102,126,234,0.15) !important;
        border-radius: 12px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        margin-bottom: 0.75rem !important;
    }

    .radio-option:hover {
        background: rgba(102,126,234,0.05) !important;
        border-color: #667eea !important;
    }

    .radio-option input[type="radio"] {
        margin-right: 1rem !important;
        width: 1.25rem !important;
        height: 1.25rem !important;
        cursor: pointer !important;
    }

    .radio-label {
        flex: 1 !important;
    }

    .radio-title {
        font-weight: 700 !important;
        font-size: 1.05rem !important;
        margin-bottom: 0.25rem !important;
    }

    .radio-description {
        font-size: 0.9rem !important;
        color: #6c757d !important;
    }

    .radio-title.pass {
        color: #28a745 !important;
    }

    .radio-title.fail {
        color: #dc3545 !important;
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

    .btn-submit {
        flex: 1 !important;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        color: white !important;
        padding: 0.875rem 2rem !important;
        font-weight: 700 !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 25px rgba(0,123,255,0.3) !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    .btn-submit:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 35px rgba(0,123,255,0.4) !important;
    }

    .btn-cancel {
        background: #f0f2f5 !important;
        color: #667eea !important;
        border: 2px solid rgba(102,126,234,0.2) !important;
        padding: 0.875rem 2rem !important;
        font-weight: 700 !important;
        border-radius: 12px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    .btn-cancel:hover {
        background: #e8ecf1 !important;
        border-color: #667eea !important;
        transform: translateY(-2px) !important;
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

        .task-header {
            flex-direction: column !important;
            gap: 1rem !important;
        }

        .modal-content {
            padding: 1.5rem !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>🧪 Testing Queue</h1>
        <a href="{{ route('tester.dashboard') }}" class="btn btn-secondary">
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

    @if(session('warning'))
        <div style="background: rgba(255,193,7,0.1); border: 2px solid #ffc107; color: #856404; padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">⚠</span>
            <div style="flex: 1;">{{ session('warning') }}</div>
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

    <!-- Tasks List -->
    <div>
        @forelse($tasks as $task)
            @php
                $latestAttempt = $task->attempts->first();
            @endphp
            <div class="task-card">
                <div class="task-header">
                    <div>
                        <h2 class="task-title">{{ $task->title }}</h2>
                        <div class="task-info">
                            <strong>Project:</strong> {{ $task->project->name ?? 'N/A' }}
                        </div>
                        <div class="task-info">
                            <strong>Developer:</strong> {{ $task->developer->name ?? 'N/A' }}
                        </div>
                        <div class="task-info">
                            <strong>Deadline:</strong> 
                            @if($task->deadline)
                                {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                            @else
                                <span style="color: #dc3545;">Not set</span>
                            @endif
                        </div>
                    </div>
                    <span class="status-badge {{ str_replace('_', '-', $task->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>

                @if($latestAttempt)
                    <div class="attempt-box">
                        <div class="attempt-header">Attempt #{{ $latestAttempt->attempt_number }}</div>
                        <div class="attempt-notes">{{ $latestAttempt->submission_notes }}</div>
                        
                        @if($latestAttempt->file_path)
                            <a href="{{ asset('storage/' . $latestAttempt->file_path) }}" target="_blank" class="file-link">
                                📎 Download File
                            </a>
                        @endif
                        
                        <div class="attempt-meta">
                        Submitted:{{ optional($latestAttempt->submitted_at)->format('M d, Y') }}
                        </div>
                    </div>

                    @if(!$latestAttempt->reviews->where('tester_id', auth()->id())->count())
                        <button onclick="openReviewModal({{ $latestAttempt->id }}, '{{ addslashes($task->title) }}')" class="btn-review">
                            📝 Review Attempt
                        </button>
                    @else
                        <div class="reviewed-badge">
                            ✓ Already Reviewed
                        </div>
                    @endif
                @else
                    <div style="text-align: center; padding: 2rem; color: #6c757d;">
                        <p>No attempts submitted yet.</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">No tasks assigned for testing</div>
                <p style="color: #6c757d; margin-top: 1rem;">You don't have any tasks assigned for testing at the moment.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal-overlay" onclick="if(event.target === this) closeReviewModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Review Task: <span id="reviewTaskTitle"></span></h2>
        </div>
        
        <form id="reviewForm" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">
                    Review Status
                    <span style="color: #dc3545;">*</span>
                </label>
                <div>
                    <label class="radio-option">
                        <input type="radio" name="status" value="pass" required>
                        <div class="radio-label">
                            <div class="radio-title pass">✓ Pass</div>
                            <div class="radio-description">Task meets requirements (+20 points, deadline bonus/penalty applies)</div>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="status" value="fail" required>
                        <div class="radio-label">
                            <div class="radio-title fail">✗ Fail</div>
                            <div class="radio-description">Task needs improvement (-10 points, failed attempts incremented)</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Remarks
                    <span style="color: #dc3545;">*</span>
                </label>
                <textarea name="remarks" rows="6" required
                    class="form-control"
                    placeholder="Provide detailed feedback on the submission..."></textarea>
                <div class="form-helper">Explain what was tested, what works, and what needs improvement</div>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn-submit">
                    ✓ Submit Review
                </button>
                <button type="button" onclick="closeReviewModal()" class="btn-cancel">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openReviewModal(attemptId, taskTitle) {
    document.getElementById('reviewTaskTitle').textContent = taskTitle;
    document.getElementById('reviewForm').action = `/tester/attempt/${attemptId}/review`;
    document.getElementById('reviewModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.remove('show');
    document.getElementById('reviewForm').reset();
    document.body.style.overflow = '';
}
</script>
@endsection
