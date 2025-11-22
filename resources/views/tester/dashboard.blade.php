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

    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
        gap: 1.5rem !important;
        margin-bottom: 2.5rem !important;
    }

    .stat-box {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 18px !important;
        padding: 2rem !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        transition: all 0.3s ease !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .stat-box::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 4px !important;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%) !important;
    }

    .stat-box:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 16px 40px rgba(102,126,234,0.2) !important;
    }

    .stat-icon {
        font-size: 2.5rem !important;
        margin-bottom: 1rem !important;
    }

    .stat-value {
        font-size: 2.5rem !important;
        font-weight: 800 !important;
        color: #667eea !important;
        margin: 1rem 0 0.5rem 0 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }

    .stat-label {
        font-size: 0.95rem !important;
        color: #6c757d !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    .card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        padding: 2rem !important;
        transition: all 0.3s ease !important;
    }

    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 45px rgba(102,126,234,0.15) !important;
    }

    .card-header {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 1.5rem !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }

    .task-item {
        border-left: 4px solid #007bff !important;
        padding: 1rem !important;
        margin-bottom: 1rem !important;
        background: rgba(0,123,255,0.05) !important;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }

    .task-item:hover {
        background: rgba(0,123,255,0.1) !important;
        transform: translateX(4px) !important;
    }

    .task-title {
        font-weight: 700 !important;
        color: #1a1a1a !important;
        font-size: 1.05rem !important;
        margin-bottom: 0.5rem !important;
    }

    .task-info {
        color: #6c757d !important;
        font-size: 0.9rem !important;
        margin-bottom: 0.25rem !important;
    }

    .btn {
        padding: 0.6rem 1.2rem !important;
        font-weight: 600 !important;
        border: none !important;
        border-radius: 8px !important;
        font-size: 0.9rem !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        display: inline-block !important;
        margin-top: 0.75rem !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(0,123,255,0.3) !important;
    }

    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(0,123,255,0.4) !important;
    }

    .btn-view-all {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 0.875rem 2rem !important;
        font-weight: 700 !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 25px rgba(102,126,234,0.3) !important;
        margin-top: 1.5rem !important;
    }

    .btn-view-all:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 35px rgba(102,126,234,0.4) !important;
    }

    .recent-task-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1rem !important;
        background: rgba(102,126,234,0.03) !important;
        border-radius: 8px !important;
        margin-bottom: 0.75rem !important;
        transition: all 0.2s ease !important;
    }

    .recent-task-item:hover {
        background: rgba(102,126,234,0.08) !important;
    }

    .item-title {
        font-weight: 700 !important;
        color: #1a1a1a !important;
        font-size: 1.05rem !important;
    }

    .item-subtitle {
        color: #6c757d !important;
        font-size: 0.9rem !important;
        margin-top: 0.25rem !important;
    }

    .status-badge {
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        text-transform: capitalize !important;
    }

    .status-badge.submitted {
        background: rgba(0,123,255,0.1) !important;
        color: #007bff !important;
    }

    .status-badge.final_completed {
        background: rgba(40,167,69,0.1) !important;
        color: #28a745 !important;
    }

    .empty-state {
        text-align: center !important;
        padding: 2rem !important;
        color: #6c757d !important;
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.75rem !important;
        }

        .stats-grid {
            grid-template-columns: 1fr !important;
        }

        .container-fluid {
            padding: 1.5rem 1rem !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>🧪 Tester Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon">📋</div>
            <div class="stat-value">{{ $stats['assigned_tasks'] }}</div>
            <div class="stat-label">Assigned Tasks</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📤</div>
            <div class="stat-value" style="color: #007bff;">{{ $stats['submitted_tasks'] }}</div>
            <div class="stat-label">Submitted</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">🔍</div>
            <div class="stat-value" style="color: #ffc107;">{{ $stats['testing_tasks'] }}</div>
            <div class="stat-label">Testing</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">✅</div>
            <div class="stat-value" style="color: #28a745;">{{ $stats['completed_tasks'] }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <!-- Tasks to Test -->
            <div class="card">
                <h2 class="card-header">Tasks Pending Review</h2>
                <div>
                    @forelse($tasksToTest as $task)
                        <div class="task-item">
                            <div class="task-title">{{ $task->title }}</div>
                            <div class="task-info">Project: {{ $task->project->name ?? 'N/A' }}</div>
                            <div class="task-info">Developer: {{ $task->developer->name ?? 'N/A' }}</div>
                            <a href="{{ route('tester.tasks') }}" class="btn btn-primary">
                                Review →
                            </a>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No tasks pending review.</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('tester.tasks') }}" class="btn-view-all">
                    View All Tasks →
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Leaderboard -->
            <div class="card">
                <h2 class="card-header">Leaderboard</h2>
                <div style="padding: 0;">
                    @forelse($leaderboard as $entry)
                        <div class="leaderboard-item" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: 1px solid rgba(102,126,234,0.1); transition: all 0.2s ease;">
                            <div>
                                <div style="font-weight: 700; color: #1a1a1a; font-size: 1.05rem;">{{ $entry['user']->name }}</div>
                                <div style="color: #6c757d; font-size: 0.85rem;">
                                    @if($entry['rankIcon'])
                                        {{ $entry['rankIcon'] }} 
                                    @endif
                                    {{ $entry['rank'] }}
                                </div>
                            </div>
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">
                                {{ $entry['points'] }} pts
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No developers found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
