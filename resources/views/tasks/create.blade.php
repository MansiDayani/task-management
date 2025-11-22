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
        padding: 3rem !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
    }

    .page-header h1 {
        font-size: 2.5rem !important;
        font-weight: 800 !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        margin-bottom: 0.5rem !important;
    }

    .page-header p {
        color: #6c757d !important;
        font-size: 1rem !important;
        margin: 0 !important;
    }

    .form-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        padding: 2.5rem !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
    }

    .form-group {
        margin-bottom: 2rem !important;
    }

    .form-group:last-child {
        margin-bottom: 0 !important;
    }

    .form-label {
        display: block !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 0.75rem !important;
        font-size: 1rem !important;
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
        background: #ffffff !important;
    }

    .form-control::placeholder {
        color: #b0b8c8 !important;
    }

    textarea.form-control {
        resize: vertical !important;
        min-height: 150px !important;
    }

    select.form-control {
        cursor: pointer !important;
        appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23667eea'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 1rem center !important;
        background-size: 1.5em 1.5em !important;
        padding-right: 3rem !important;
    }

    .form-helper {
        font-size: 0.85rem !important;
        color: #6c757d !important;
        margin-top: 0.5rem !important;
    }

    .form-actions {
        display: flex !important;
        gap: 1.5rem !important;
        justify-content: flex-end !important;
        margin-top: 2.5rem !important;
        padding-top: 2rem !important;
        border-top: 1px solid rgba(102,126,234,0.1) !important;
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

    .btn-cancel {
        background: #f0f2f5 !important;
        color: #667eea !important;
        border: 2px solid rgba(102,126,234,0.2) !important;
    }

    .btn-cancel:hover {
        background: #e8ecf1 !important;
        border-color: #667eea !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.15) !important;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        box-shadow: 0 8px 25px rgba(102,126,234,0.3) !important;
    }

    .btn-submit:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 35px rgba(102,126,234,0.4) !important;
    }

    .btn-submit:active {
        transform: translateY(0) !important;
    }

    .error-message {
        color: #dc3545 !important;
        font-size: 0.875rem !important;
        margin-top: 0.5rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
    }

    .form-group.error .form-control {
        border-color: #dc3545 !important;
        background: rgba(220,53,69,0.05) !important;
    }

    .alert {
        padding: 1.25rem !important;
        border-radius: 12px !important;
        margin-bottom: 2rem !important;
        display: flex !important;
        align-items: flex-start !important;
        gap: 1rem !important;
    }

    .alert-danger {
        background: rgba(220,53,69,0.1) !important;
        border: 2px solid #dc3545 !important;
        color: #721c24 !important;
    }

    .alert-success {
        background: rgba(40,167,69,0.1) !important;
        border: 2px solid #28a745 !important;
        color: #155724 !important;
    }

    .team-section {
        margin-top: 2rem !important;
        padding-top: 2rem !important;
        border-top: 2px solid rgba(102,126,234,0.1) !important;
    }

    .team-section-title {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 1.5rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    .team-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 1.5rem !important;
    }

    .team-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.8) 0%, rgba(248,249,255,0.8) 100%) !important;
        border: 2px solid rgba(102,126,234,0.15) !important;
        border-radius: 16px !important;
        padding: 1.5rem !important;
        transition: all 0.3s ease !important;
    }

    .team-card:hover {
        border-color: #667eea !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.15) !important;
        transform: translateY(-2px) !important;
    }

    .team-card.developer {
        border-left: 4px solid #3b82f6 !important;
    }

    .team-card.tester {
        border-left: 4px solid #10b981 !important;
    }

    .team-card.pm {
        border-left: 4px solid #8b5cf6 !important;
    }

    .team-card-label {
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #6c757d !important;
        margin-bottom: 0.5rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem !important;
            margin-bottom: 1.5rem !important;
        }

        .page-header h1 {
            font-size: 1.75rem !important;
        }

        .form-card {
            padding: 1.5rem !important;
        }

        .form-actions {
            flex-direction: column-reverse !important;
            gap: 1rem !important;
        }

        .btn {
            width: 100% !important;
        }

        .team-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>📝 Create New Task</h1>
        <p>Assign a task to your team members and set deadlines</p>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <div style="flex: 1;">
                    <strong>Oops! Please fix the following errors:</strong>
                    <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <!-- Project Field -->
            <div class="form-group @error('project_id') error @enderror">
                <label for="project_id" class="form-label">
                    Project
                    <span style="color: #dc3545;">*</span>
                </label>
                <select 
                    id="project_id"
                    name="project_id" 
                    class="form-control @error('project_id') is-invalid @enderror"
                    required>
                    <option value="">Select a project...</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="error-message">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Title Field -->
            <div class="form-group @error('title') error @enderror">
                <label for="title" class="form-label">
                    Task Title
                    <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="title"
                    name="title" 
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}"
                    placeholder="Enter task title"
                    required>
                @error('title')
                    <div class="error-message">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
                <div class="form-helper">Maximum 255 characters</div>
            </div>

            <!-- Description Field -->
            <div class="form-group @error('description') error @enderror">
                <label for="description" class="form-label">
                    Description
                </label>
                <textarea 
                    id="description"
                    name="description" 
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Describe the task requirements, objectives, and any specific details... (optional)"
                    rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
                <div class="form-helper">Provide detailed information about the task</div>
            </div>

            <!-- Team Assignment Section -->
            <div class="team-section">
                <h3 class="team-section-title">👥 Team Assignment</h3>
                
                <div class="team-grid">
                    <!-- Developer -->
                    <div class="team-card developer">
                        <div class="team-card-label">
                            Developer
                            <span style="color: #dc3545;">*</span>
                        </div>
                        <div class="form-group @error('developer_id') error @enderror" style="margin-bottom: 0 !important;">
                            <select 
                                name="developer_id" 
                                class="form-control @error('developer_id') is-invalid @enderror"
                                required>
                                <option value="">Select developer...</option>
                                @foreach($developers as $dev)
                                    <option value="{{ $dev->id }}" {{ old('developer_id') == $dev->id ? 'selected' : '' }}>
                                        {{ $dev->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('developer_id')
                                <div class="error-message">
                                    <span>⚠</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tester -->
                    <div class="team-card tester">
                        <div class="team-card-label">
                            Tester
                            <span style="color: #dc3545;">*</span>
                        </div>
                        <div class="form-group @error('tester_id') error @enderror" style="margin-bottom: 0 !important;">
                            <select 
                                name="tester_id" 
                                class="form-control @error('tester_id') is-invalid @enderror"
                                required>
                                <option value="">Select tester...</option>
                                @foreach($testers as $tester)
                                    <option value="{{ $tester->id }}" {{ old('tester_id') == $tester->id ? 'selected' : '' }}>
                                        {{ $tester->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tester_id')
                                <div class="error-message">
                                    <span>⚠</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- PM -->
                    <div class="team-card pm">
                        <div class="team-card-label">
                            Project Manager
                            <span style="color: #dc3545;">*</span>
                        </div>
                        <div class="form-group @error('pm_id') error @enderror" style="margin-bottom: 0 !important;">
                            <select 
                                name="pm_id" 
                                class="form-control @error('pm_id') is-invalid @enderror"
                                required>
                                <option value="">Select PM...</option>
                                @foreach($pms as $pm)
                                    <option value="{{ $pm->id }}" {{ old('pm_id') == $pm->id ? 'selected' : '' }}>
                                        {{ $pm->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pm_id')
                                <div class="error-message">
                                    <span>⚠</span> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deadline Field -->
            <div class="form-group @error('deadline') error @enderror">
                <label for="deadline" class="form-label">
                    Deadline
                    <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="date" 
                    id="deadline"
                    name="deadline" 
                    class="form-control @error('deadline') is-invalid @enderror"
                    value="{{ old('deadline') }}"
                    min="{{ date('Y-m-d') }}"
                    required>
                @error('deadline')
                    <div class="error-message">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
                <div class="form-helper">Select a deadline date for this task</div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-submit">
                    <span>✓</span> Create Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
