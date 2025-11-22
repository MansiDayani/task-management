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
        font-size: 1.75rem !important;
        font-weight: 700 !important;
        color: #764ba2 !important;
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

    .summary-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        padding: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .summary-card h2 {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #667eea !important;
        margin-bottom: 1.5rem !important;
    }

    .user-point-card {
        background: linear-gradient(135deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%) !important;
        border: 2px solid rgba(102,126,234,0.15) !important;
        border-radius: 16px !important;
        padding: 1.5rem !important;
        transition: all 0.3s ease !important;
    }

    .user-point-card:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 8px 20px rgba(102,126,234,0.15) !important;
        border-color: #667eea !important;
    }

    .user-name {
        font-weight: 700 !important;
        color: #1a1a1a !important;
        font-size: 1.05rem !important;
        margin-bottom: 0.25rem !important;
    }

    .user-role {
        color: #6c757d !important;
        font-size: 0.9rem !important;
        margin-bottom: 0.75rem !important;
    }

    .user-points-value {
        font-size: 2rem !important;
        font-weight: 800 !important;
        color: #764ba2 !important;
    }

    .points-table {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(102,126,234,0.1) !important;
        overflow: hidden !important;
    }

    .points-table table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    .points-table thead {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%) !important;
    }

    .points-table th {
        padding: 1.5rem !important;
        color: #667eea !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-bottom: 2px solid rgba(102,126,234,0.15) !important;
    }

    .points-table tbody tr {
        transition: all 0.2s ease !important;
        border-bottom: 1px solid rgba(102,126,234,0.08) !important;
    }

    .points-table tbody tr:hover {
        background: rgba(102,126,234,0.04) !important;
    }

    .points-table td {
        padding: 1.5rem !important;
        color: #1a1a1a !important;
    }

    .user-name-cell {
        font-weight: 700 !important;
        color: #667eea !important;
    }

    .task-name-cell {
        color: #1a1a1a !important;
    }

    .reason-cell {
        color: #6c757d !important;
    }

    .points-badge {
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        display: inline-block !important;
    }

    .points-badge.positive {
        background: rgba(40,167,69,0.1) !important;
        color: #28a745 !important;
    }

    .points-badge.negative {
        background: rgba(220,53,69,0.1) !important;
        color: #dc3545 !important;
    }

    .date-cell {
        color: #6c757d !important;
        font-weight: 500 !important;
    }

    .empty-state {
        text-align: center !important;
        padding: 3rem 2rem !important;
        color: #6c757d !important;
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

        .points-table th,
        .points-table td {
            padding: 1rem !important;
            font-size: 0.9rem !important;
        }

        .container-fluid {
            padding: 1.5rem 1rem !important;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>⭐ Points System</h1>
            <p>Total Points: <span class="points-display">{{ $totalPoints }}</span></p>
        </div>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                ← Dashboard
            </a>
        @endif
    </div>

    @if(auth()->user()->role == 'admin' && $userPoints->count() > 0)
        <!-- User Points Summary -->
        <div class="summary-card">
            <h2>User Points Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($userPoints as $userPoint)
                    <div class="user-point-card">
                        <div class="user-name">{{ $userPoint->user->name }}</div>
                        <div class="user-role">{{ ucfirst($userPoint->user->role) }}</div>
                        <div class="user-points-value">{{ $userPoint->total }} pts</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Points History Table -->
    <div class="points-table">
        <div style="padding: 1.5rem; border-bottom: 2px solid rgba(102,126,234,0.1);">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #667eea; margin: 0;">Points History</h2>
        </div>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Task</th>
                        <th>Reason</th>
                        <th>Points</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($points as $point)
                        <tr>
                            <td>
                                <div class="user-name-cell">{{ $point->user->name }}</div>
                            </td>
                            <td>
                                <div class="task-name-cell">{{ $point->task->title ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <div class="reason-cell">{{ $point->reason }}</div>
                            </td>
                            <td>
                                <span class="points-badge {{ $point->points > 0 ? 'positive' : 'negative' }}">
                                    {{ $point->points > 0 ? '+' : '' }}{{ $point->points }}
                                </span>
                            </td>
                            <td>
                                <div class="date-cell">{{ $point->created_at->format('M d, Y H:i') }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                No points recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($points->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid rgba(102,126,234,0.1);">
                {{ $points->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
