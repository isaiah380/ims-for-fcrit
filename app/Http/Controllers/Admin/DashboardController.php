<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with system-wide statistics.
     */
    public function index(Request $request): View
    {
        $stats = [
            'total_students'     => User::where('role', 'student')->count(),
            'total_faculty'      => User::where('role', 'faculty')->count(),
            'total_achievements' => Achievement::count(),
            'pending_count'      => Achievement::pending()->count(),
        ];

        $departmentCounts = User::where('role', 'student')
            ->whereNotNull('department')
            ->select('department', DB::raw('count(*) as count'))
            ->groupBy('department')
            ->pluck('count', 'department');
            
        $departmentStats = [];
        foreach (['CE', 'ME', 'EXTC', 'EE', 'CSE', 'BSH'] as $dept) {
            $departmentStats[$dept] = $departmentCounts->get($dept, 0);
        }

        return view('admin.dashboard', compact('stats', 'departmentStats'));
    }
}
