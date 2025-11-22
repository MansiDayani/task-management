<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    /**
     * Display a listing of points.
     */
    public function index()
    {
        // Admin can see all points, others see only their own
        if (Auth::user()->role === 'admin') {
            $points = Point::with(['user', 'task'])
                ->latest()
                ->paginate(20);
            
            $totalPoints = Point::sum('points');
            $userPoints = Point::selectRaw('user_id, SUM(points) as total')
                ->groupBy('user_id')
                ->with('user')
                ->get();
        } else {
            $points = Point::with(['user', 'task'])
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(20);
            
            $totalPoints = Point::where('user_id', Auth::id())->sum('points');
            $userPoints = collect([]);
        }

        return view('points.index', compact('points', 'totalPoints', 'userPoints'));
    }
}
