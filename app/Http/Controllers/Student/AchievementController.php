<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AchievementController extends Controller
{
    /**
     * List all achievements for the authenticated student.
     */
    public function index(Request $request): View
    {
        $achievements = $request->user()
            ->achievements()
            ->latest()
            ->paginate(10);

        return view('student.achievements.index', compact('achievements'));
    }

    /**
     * Show the form to create a new achievement.
     */
    public function create(): View
    {
        return view('student.achievements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'in:Internship,Certificate,Competition,Paper Publication'],
            'description' => ['required', 'string'],
            'file'        => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('achievements', 'public');
        }

        $request->user()->achievements()->create([
            'title'       => $validated['title'],
            'category'    => $validated['category'],
            'description' => $validated['description'],
            'file_path'   => $filePath,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('student.achievements.index')
            ->with('success', 'Achievement submitted successfully.');
    }

    /**
     * Display the specified achievement.
     */
    public function show(Achievement $achievement): View
    {
        // Ensure the student can only view their own achievements
        if ($achievement->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to view this achievement.');
        }

        return view('student.achievements.show', compact('achievement'));
    }
}
