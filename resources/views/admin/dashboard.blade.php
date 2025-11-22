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
        margin-bottom: 2rem !important;
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

    .status-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
        gap: 1rem !important;
        margin-bottom: 2.5rem !important;
    }

    .status-box {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 12px !important;
        padding: 1.5rem !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        text-align: center !important;
        transition: all 0.3s ease !important;
    }

    .status-box:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 8px 25px rgba(102,126,234,0.15) !important;
    }

    .status-value {
        font-size: 2rem !important;
        font-weight: 800 !important;
        margin-bottom: 0.5rem !important;
    }

    .status-label {
        font-size: 0.85rem !important;
        color: #6c757d !important;
        font-weight: 600 !important;
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

    .task-item, .user-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1rem !important;
        background: rgba(102,126,234,0.03) !important;
        border-radius: 8px !important;
        margin-bottom: 0.75rem !important;
        transition: all 0.2s ease !important;
    }

    .task-item:hover, .user-item:hover {
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

    .status-badge.pending {
        background: rgba(255,193,7,0.1) !important;
        color: #ffc107 !important;
    }

    .status-badge.submitted {
        background: rgba(0,123,255,0.1) !important;
        color: #007bff !important;
    }

    .status-badge.final_completed {
        background: rgba(40,167,69,0.1) !important;
        color: #28a745 !important;
    }

    .status-badge.failed {
        background: rgba(220,53,69,0.1) !important;
        color: #dc3545 !important;
    }

    .user-rank {
        width: 2.5rem !important;
        height: 2.5rem !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: white !important;
        font-weight: 700 !important;
        font-size: 1.1rem !important;
        margin-right: 1rem !important;
    }

    .user-info {
        flex: 1 !important;
    }

    .user-name {
        font-weight: 700 !important;
        color: #1a1a1a !important;
        font-size: 1.05rem !important;
    }

    .user-role {
        color: #6c757d !important;
        font-size: 0.9rem !important;
        margin-top: 0.25rem !important;
    }

    .user-points {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #764ba2 !important;
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

        .stats-grid, .status-grid {
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
        <h1>👑 Admin Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon">📁</div>
            <div class="stat-value">{{ $stats['total_projects'] }}</div>
            <div class="stat-label">Projects</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📋</div>
            <div class="stat-value">{{ $stats['total_tasks'] }}</div>
            <div class="stat-label">Tasks</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">👥</div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Users</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">⭐</div>
            <div class="stat-value" style="color: #764ba2;">{{ $stats['total_points'] }}</div>
            <div class="stat-label">Total Points</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">⏳</div>
            <div class="stat-value" style="color: #ffc107;">{{ $stats['pending_tasks'] }}</div>
            <div class="stat-label">Pending</div>
        </div>
    </div>

    <!-- Task Status Grid -->
    <div class="status-grid">
        <div class="status-box">
            <div class="status-value" style="color: #ffc107;">{{ $stats['pending_tasks'] }}</div>
            <div class="status-label">Pending</div>
        </div>
        <div class="status-box">
            <div class="status-value" style="color: #007bff;">{{ $stats['submitted_tasks'] }}</div>
            <div class="status-label">Submitted</div>
        </div>
        <div class="status-box">
            <div class="status-value" style="color: #667eea;">{{ $stats['testing_tasks'] }}</div>
            <div class="status-label">Testing</div>
        </div>
        <div class="status-box">
            <div class="status-value" style="color: #ff9800;">{{ $stats['pm_review_tasks'] }}</div>
            <div class="status-label">PM Review</div>
        </div>
        <div class="status-box">
            <div class="status-value" style="color: #28a745;">{{ $stats['completed_tasks'] }}</div>
            <div class="status-label">Completed</div>
        </div>
        <div class="status-box">
            <div class="status-value" style="color: #dc3545;">{{ $stats['failed_tasks'] }}</div>
            <div class="status-label">Failed</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <!-- Recent Tasks -->
            <div class="card">
                <h2 class="card-header">Recent Tasks</h2>
                <div>
                    @forelse($recentTasks as $task)
                        <div class="task-item">
                            <div>
                                <div class="item-title">{{ $task->title }}</div>
                                <div class="item-subtitle">{{ $task->project->name ?? 'N/A' }}</div>
                            </div>
                            <span class="status-badge {{ str_replace('_', '-', $task->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No tasks available.</p>
                        </div>
                    @endforelse
                </div>
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
