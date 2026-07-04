<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard with achievement statistics.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $stats = [
            'total'    => $user->achievements()->count(),
            'pending'  => $user->achievements()->pending()->count(),
            'approved' => $user->achievements()->approved()->count(),
            'rejected' => $user->achievements()->rejected()->count(),
        ];

        $recentAchievements = $user->achievements()
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact('stats', 'recentAchievements'));
    }
}
