<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the faculty dashboard with submission statistics.
     */
    public function index(Request $request): View
    {
        $stats = [
            'total'          => Achievement::count(),
            'pending'        => Achievement::pending()->count(),
            'approved_today' => Achievement::approved()
                ->whereDate('reviewed_at', today())
                ->count(),
            'rejected_today' => Achievement::rejected()
                ->whereDate('reviewed_at', today())
                ->count(),
        ];

        $recentPending = Achievement::with('user')
            ->pending()
            ->latest()
            ->take(5)
            ->get();

        return view('faculty.dashboard', compact('stats', 'recentPending'));
    }
}
