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
        border-left: 4px solid #667eea !important;
        padding-left: 1rem !important;
        padding: 1rem !important;
        margin-bottom: 1rem !important;
        background: rgba(102,126,234,0.03) !important;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }

    .task-item:hover {
        background: rgba(102,126,234,0.08) !important;
        transform: translateX(4px) !important;
    }

    .task-title {
        font-weight: 700 !important;
        color: #1a1a1a !important;
        font-size: 1.05rem !important;
        margin-bottom: 0.25rem !important;
    }

    .task-project {
        color: #6c757d !important;
        font-size: 0.9rem !important;
        margin-bottom: 0.5rem !important;
    }

    .task-status {
        font-size: 0.85rem !important;
        color: #6c757d !important;
    }

    .status-text {
        font-weight: 600 !important;
        color: #667eea !important;
    }

    .point-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1rem !important;
        background: rgba(102,126,234,0.03) !important;
        border-radius: 8px !important;
        margin-bottom: 0.75rem !important;
        transition: all 0.2s ease !important;
    }

    .point-item:hover {
        background: rgba(102,126,234,0.08) !important;
    }

    .point-reason {
        font-weight: 600 !important;
        color: #1a1a1a !important;
        font-size: 0.95rem !important;
    }

    .point-task {
        color: #6c757d !important;
        font-size: 0.85rem !important;
        margin-top: 0.25rem !important;
    }

    .point-value {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
    }

    .point-value.positive {
        color: #28a745 !important;
    }

    .point-value.negative {
        color: #dc3545 !important;
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
        <h1>👨‍💻 Developer Dashboard</h1>
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
            <div class="stat-icon">⏳</div>
            <div class="stat-value" style="color: #ffc107;">{{ $stats['pending_tasks'] }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📤</div>
            <div class="stat-value" style="color: #007bff;">{{ $stats['submitted_tasks'] }}</div>
            <div class="stat-label">Submitted</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">✅</div>
            <div class="stat-value" style="color: #28a745;">{{ $stats['completed_tasks'] }}</div>
            <div class="stat-label">Completed</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">⭐</div>
            <div class="stat-value" style="color: #764ba2;">{{ $stats['total_points'] }}</div>
            <div class="stat-label">Total Points</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <!-- My Tasks -->
            <div class="card">
                <h2 class="card-header">My Tasks</h2>
                <div>
                    @forelse($myTasks as $task)
                        <div class="task-item">
                            <div class="task-title">{{ $task->title }}</div>
                            <div class="task-project">{{ $task->project->name ?? 'N/A' }}</div>
                            <div class="task-status">
                                Status: <span class="status-text">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No tasks assigned yet.</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('developer.tasks') }}" class="btn btn-primary" style="margin-top: 1.5rem;">
                    View All Tasks →
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Recent Points -->
            <div class="card">
                <h2 class="card-header">Recent Points</h2>
                <div>
                    @forelse($recentPoints as $point)
                        <div class="point-item">
                            <div>
                                <div class="point-reason">{{ $point->reason }}</div>
                                <div class="point-task">{{ $point->task->title ?? 'N/A' }}</div>
                            </div>
                            <div class="point-value {{ $point->points > 0 ? 'positive' : 'negative' }}">
                                {{ $point->points > 0 ? '+' : '' }}{{ $point->points }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No points recorded yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
