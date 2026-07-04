<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    /**
     * List all achievements with optional filters and search.
     */
    public function index(Request $request): View
    {
        $query = Achievement::with('user');

        // Search by title, student name, or roll number
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('roll_number', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by student's department
        if ($department = $request->query('department')) {
            $query->whereHas('user', function ($q) use ($department) {
                $q->where('department', $department);
            });
        }

        // Filter by achievement category
        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        // Filter by status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $achievements = $query->latest()->paginate(15)->withQueryString();

        return view('faculty.submissions.index', compact('achievements'));
    }

    /**
     * Display a single achievement submission with student details.
     */
    public function show(Achievement $achievement): View
    {
        $achievement->load('user');

        return view('faculty.submissions.show', compact('achievement'));
    }

    /**
     * Review (approve or reject) an achievement submission.
     */
    public function review(Request $request, Achievement $achievement): RedirectResponse
    {
        $validated = $request->validate([
            'status'  => ['required', 'string', 'in:approved,rejected'],
            'remarks' => ['nullable', 'string'],
        ]);

        $achievement->update([
            'status'      => $validated['status'],
            'remarks'     => $validated['remarks'] ?? null,
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Submission has been ' . $validated['status'] . '.');
    }
}
