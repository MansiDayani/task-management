<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PMTaskController extends Controller
{
    /**
     * Display tasks for PM review.
     */
    public function index()
    {
        $tasks = Task::with(['project', 'developer', 'tester', 'attempts' => function($query) {
            $query->with('reviews')->latest();
        }])
            ->where('status', 'pm_review')
            ->where('pm_id', Auth::id())
            ->latest()
            ->get();

        // Get the latest attempt for each task
        foreach ($tasks as $task) {
            $task->latestAttempt = $task->attempts->first();
            if ($task->latestAttempt) {
                $task->latestReview = $task->latestAttempt->reviews->first();
            }
        }

        return view('pm.tasks', compact('tasks'));
    }
}
