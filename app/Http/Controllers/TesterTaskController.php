<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesterTaskController extends Controller
{
    /**
     * Display tasks assigned to the tester.
     */
    public function index()
    {
        $tasks = Task::with(['project', 'developer', 'attempts' => function($query) {
            $query->with('reviews')->latest();
        }])
            ->where('tester_id', Auth::id())
            ->whereIn('status', ['submitted', 'testing'])
            ->latest()
            ->get();

        return view('tester.tasks', compact('tasks'));
    }
}
