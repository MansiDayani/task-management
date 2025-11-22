<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttempt;
use App\Models\User;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesterController extends Controller
{
    /**
     * Display the tester dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'assigned_tasks' => Task::where('tester_id', $user->id)->count(),
            'submitted_tasks' => Task::where('tester_id', $user->id)
                ->where('status', 'submitted')->count(),
            'testing_tasks' => Task::where('tester_id', $user->id)
                ->where('status', 'testing')->count(),
            'completed_tasks' => Task::where('tester_id', $user->id)
                ->where('status', 'final_completed')->count(),
        ];

        // Get tasks that need testing (submitted status)
        $tasksToTest = Task::with(['project', 'developer', 'attempts' => function($query) {
            $query->latest()->first();
        }])
            ->where('tester_id', $user->id)
            ->where('status', 'submitted')
            ->latest()
            ->get();

        $recentTasks = Task::with(['project', 'developer'])
            ->where('tester_id', $user->id)
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

        return view('tester.dashboard', compact('stats', 'tasksToTest', 'recentTasks', 'leaderboard'));
    }
}
