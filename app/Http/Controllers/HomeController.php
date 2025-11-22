<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // Redirect to role-specific dashboard
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'pm':
                return redirect()->route('pm.dashboard');
            case 'tester':
                return redirect()->route('tester.dashboard');
            case 'developer':
                return redirect()->route('developer.dashboard');
            default:
                // Fallback: show home page with role-based content
                $data = [
                    'role' => $user->role,
                    'counts' => [],
                    'tasks' => collect([]),
                ];
                return view('home', $data);
        }
    }
}
