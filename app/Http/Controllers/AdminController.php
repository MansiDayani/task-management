<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Point;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_projects' => Project::count(),
            'total_tasks' => Task::count(),
            'total_users' => User::count(),
            'total_points' => Point::sum('points'),
            'pending_tasks' => Task::where('status', 'pending')->count(),
            'submitted_tasks' => Task::where('status', 'submitted')->count(),
            'testing_tasks' => Task::where('status', 'testing')->count(),
            'pm_review_tasks' => Task::where('status', 'pm_review')->count(),
            'completed_tasks' => Task::where('status', 'final_completed')->count(),
            'failed_tasks' => Task::where('status', 'failed')->count(),
        ];

        $recentTasks = Task::with(['project', 'developer', 'tester', 'pm'])
            ->latest()
            ->limit(10)
            ->get();

        // Get leaderboard - developers with their total points
        $leaderboard = User::where('role', 'developer')
            ->withSum('points', 'points')
            ->orderBy('points_sum_points', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                $totalPoints = $user->points_sum_points ?? 0;
                // Determine rank based on points
                if ($totalPoints >= 100) {
                    $rank = 'Expert';
                    $rankIcon = '⭐';
                } elseif ($totalPoints >= 50) {
                    $rank = 'Advanced';
                    $rankIcon = '';
                } else {
                    $rank = 'Intermediate';
                    $rankIcon = '';
                }
                return [
                    'user' => $user,
                    'points' => $totalPoints,
                    'rank' => $rank,
                    'rankIcon' => $rankIcon,
                ];
            });

        return view('admin.dashboard', compact('stats', 'recentTasks', 'leaderboard'));
    }
}
