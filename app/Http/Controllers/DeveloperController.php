<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    /**
     * Display the developer dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'assigned_tasks' => Task::where('developer_id', $user->id)->count(),
            'pending_tasks' => Task::where('developer_id', $user->id)
                ->where('status', 'pending')->count(),
            'submitted_tasks' => Task::where('developer_id', $user->id)
                ->where('status', 'submitted')->count(),
            'completed_tasks' => Task::where('developer_id', $user->id)
                ->where('status', 'final_completed')->count(),
            'total_points' => Point::where('user_id', $user->id)->sum('points'),
        ];

        $myTasks = Task::with(['project', 'tester', 'pm', 'attempts'])
            ->where('developer_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $recentPoints = Point::with('task')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('developer.dashboard', compact('stats', 'myTasks', 'recentPoints'));
    }
}
