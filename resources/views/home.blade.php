@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
    }
    * {
        box-sizing: border-box;
    }
    html, body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    #app {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        min-height: 100vh;
    }
    .navbar {
        background-color: rgba(255, 255, 255, 0.95) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .container-fluid {
        max-width: 1400px !important;
        margin: 0 auto !important;
        padding: 3rem 2rem !important;
        background: transparent !important;
    }
    .dashboard-header {
        background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%) !important;
        border-radius: 24px !important;
        padding: 3rem !important;
        margin-bottom: 3rem !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
    }
    .dashboard-header h1 {
        font-size: 3rem !important;
        font-weight: 800 !important;
        color: #667eea !important;
        margin-bottom: 0.5rem !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    .dashboard-header p {
        color: #6c757d !important;
        font-size: 1.05rem !important;
        margin-bottom: 0 !important;
    }
    .dashboard-header strong {
        color: #667eea !important;
        font-weight: 700 !important;
    }
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 1.5rem !important;
        margin-bottom: 3rem !important;
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
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    .card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        transition: all 0.3s ease !important;
    }
    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 45px rgba(102,126,234,0.15) !important;
    }
    .card-header {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
        border-bottom: 2px solid rgba(102,126,234,0.15) !important;
        padding: 1.75rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
        font-size: 1.15rem !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    .card-body {
        background: transparent !important;
    }
    .table {
        margin-bottom: 0 !important;
    }
    .table thead {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
    }
    .table thead th {
        color: #667eea !important;
        font-weight: 700 !important;
        border: none !important;
        padding: 1.2rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }
    .table tbody tr {
        transition: all 0.2s ease !important;
    }
    .table tbody tr:hover {
        background: rgba(102,126,234,0.04) !important;
    }
    .table tbody td {
        border-top: 1px solid rgba(102,126,234,0.1) !important;
        padding: 1rem !important;
    }
    .badge {
        padding: 0.6rem 1rem !important;
        font-weight: 700 !important;
        border-radius: 10px !important;
        font-size: 0.8rem !important;
        text-transform: capitalize !important;
    }
    .badge.bg-secondary {
        background: linear-gradient(135deg, #9775FA 0%, #b197fc 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(151,117,250,0.3) !important;
    }
    .btn {
        border-radius: 12px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(102,126,234,0.3) !important;
    }
    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(102,126,234,0.4) !important;
        color: white !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    .btn-outline-primary {
        color: #667eea !important;
        border: 2px solid #667eea !important;
        background: transparent !important;
    }
    .btn-outline-primary:hover {
        background: #667eea !important;
        color: white !important;
        border-color: #667eea !important;
    }
    .btn-sm {
        padding: 0.5rem 1rem !important;
    }
    .btn-secondary {
        background: #6c757d !important;
        color: white !important;
    }
    .btn-secondary:hover {
        background: #5a6268 !important;
        color: white !important;
    }
    .modal-content {
        border-radius: 20px !important;
        border: none !important;
        background: #ffffff !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2) !important;
    }
    .modal-header {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
        border-bottom: 2px solid rgba(102,126,234,0.15) !important;
        padding: 2rem !important;
    }
    .modal-title {
        color: #667eea !important;
        font-weight: 800 !important;
        font-size: 1.4rem !important;
    }
    .leaderboard-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1.25rem !important;
        border-bottom: 1px solid rgba(102,126,234,0.08) !important;
    }
    .leaderboard-name {
        font-weight: 700 !important;
        color: #1a1a1a !important;
    }
    .leaderboard-points {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 0.5rem 1.2rem !important;
        border-radius: 10px !important;
        font-weight: 700 !important;
    }
    .btn-close {
        color: #667eea !important;
    }
    .row.g-4 {
        margin-bottom: 3rem !important;
    }
    @media (max-width: 768px) {
        .dashboard-header h1 { font-size: 2rem !important; }
        .stats-grid { grid-template-columns: 1fr !important; }
        .container-fluid { padding: 1.5rem 1rem !important; }
        .dashboard-header { padding: 1.5rem !important; }
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>Dashboard</h1>
                <p>Welcome back, <strong>{{ auth()->user()->name ?? 'User' }}</strong> • Role: <strong>{{ ucfirst($role ?? auth()->user()->role) }}</strong></p>
            </div>
            <div class="col-lg-4">
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    @php
                        $userRole = $role ?? auth()->user()->role;
                    @endphp
                    
                    @if(in_array($userRole, ['admin','pm']))
                        {{-- Projects --}}
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">Projects</a>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
                    @elseif($userRole == 'developer')
                        <a href="{{ route('developer.tasks') }}" class="btn btn-primary">My Tasks</a>
                    @elseif($userRole == 'tester')
                        <a href="{{ route('tester.tasks') }}" class="btn btn-primary">Testing Queue</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon">📊</div>
            <div class="stat-label">Total Projects</div>
            <div class="stat-value">{{ $counts['projects'] ?? 0 }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">✓</div>
            <div class="stat-label">Your Tasks</div>
            <div class="stat-value">{{ $counts['assigned'] ?? $counts['tasks'] ?? 0 }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">⚙</div>
            <div class="stat-label">Pending Review</div>
            <div class="stat-value">{{ $counts['tasks_pending_pm_review'] ?? 0 }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📋</div>
            <div class="stat-label">All Tasks</div>
            <div class="stat-value">{{ $counts['tasks'] ?? $counts['all_tasks'] ?? 0 }}</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Recent Tasks</span>
                    @if(in_array($role ?? auth()->user()->role, ['admin','pm']))
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">+ Create Task</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($tasks->isEmpty())
                        <div style="text-align: center; padding: 3rem 2rem; color: #6c757d;">
                            <p>No tasks assigned yet</p>
                            <p style="font-size: 0.9rem;">Create a new project to get started!</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Developer</th>
                                        <th>Deadline</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td style="font-weight: bold;">{{ $task->title }}</td>
                                            <td>{{ optional($task->project)->name }}</td>
                                            <td><span class="badge bg-secondary">{{ $task->status }}</span></td>
                                            <td>{{ optional($task->developer)->name ?? '-' }}</td>
                                            <td>
                                                @if($task->deadline)
                                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                                @else
                                                    <span style="color: #dc3545;">Not set</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#taskModal" data-task='@json($task)'>View</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Leaderboard</div>
                <div class="card-body" style="padding: 0;">
                    <div class="leaderboard-item">
                        <div>
                            <div class="leaderboard-name">Dev A</div>
                            <div style="color: #6c757d; font-size: 0.85rem;">⭐ Expert</div>
                        </div>
                        <div class="leaderboard-points">120 pts</div>
                    </div>
                    <div class="leaderboard-item">
                        <div>
                            <div class="leaderboard-name">Dev B</div>
                            <div style="color: #6c757d; font-size: 0.85rem;">Advanced</div>
                        </div>
                        <div class="leaderboard-points">95 pts</div>
                    </div>
                    <div class="leaderboard-item">
                        <div>
                            <div class="leaderboard-name">Dev C</div>
                            <div style="color: #6c757d; font-size: 0.85rem;">Intermediate</div>
                        </div>
                        <div class="leaderboard-points">88 pts</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="taskDetailsRoot">
                    <p class="text-muted">Loading…</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const taskModal = document.getElementById('taskModal');
    if(!taskModal) return;
    taskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const raw = button.getAttribute('data-task');
        let html = '';
        try {
            const data = JSON.parse(raw);
            html += `<h5>${data.title || ''}</h5>`;
            html += `<p><strong>Project:</strong> ${data.project?.name ?? '-'}</p>`;
            html += `<p>${data.description ?? '<em>No description</em>'}</p>`;
            html += `<hr>`;
            html += `<p><strong>Developer:</strong> ${data.developer?.name ?? '-'}</p>`;
            html += `<p><strong>Tester:</strong> ${data.tester?.name ?? '-'}</p>`;
            html += `<p><strong>Status:</strong> ${data.status ?? '-'}</p>`;
            html += `<p><strong>Deadline:</strong> ${data.deadline ?? '-'}</p>`;
            html += `<p><strong>Failed Attempts:</strong> ${data.failed_attempts ?? 0}</p>`;
        } catch(e) {
            html = `<p class="text-danger">Failed to load task details</p>`;
        }
        document.getElementById('taskDetailsRoot').innerHTML = html;
    });
});
</script>

@endsection