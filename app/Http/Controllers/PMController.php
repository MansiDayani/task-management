<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PMController extends Controller
{
    /**
     * Display the PM dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'all_tasks' => Task::count(),
            'pending_pm_review' => Task::where('status', 'pm_review')->count(),
            'my_projects_tasks' => Task::where('pm_id', $user->id)->count(),
            'completed_tasks' => Task::where('status', 'final_completed')->count(),
        ];

        // Get tasks pending PM review (assigned to this PM)
        $pendingReview = Task::with(['project', 'developer', 'tester', 'attempts' => function($query) {
            $query->latest()->first();
        }])
            ->where('status', 'pm_review')
            ->where('pm_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $allTasks = Task::with(['project', 'developer', 'tester'])
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

        return view('pm.dashboard', compact('stats', 'pendingReview', 'allTasks', 'leaderboard'));
    }
}
