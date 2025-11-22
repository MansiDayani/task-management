<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperTaskController extends Controller
{
    /**
     * Display a listing of tasks assigned to the developer.
     */
    public function index()
    {
        $tasks = Task::with(['project', 'tester', 'pm', 'attempts'])
            ->where('developer_id', Auth::id())
            ->latest()
            ->get();

        // Calculate points earned by this developer
        $totalPoints = \App\Models\Point::where('user_id', Auth::id())
            ->sum('points');

        return view('developer.tasks', compact('tasks', 'totalPoints'));
    }
}
