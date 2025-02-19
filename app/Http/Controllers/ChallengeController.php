<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChallengeController extends Controller
{
    public function index(): View
    {
        $challenges = Challenge::where('teacher_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('challenges.index', compact('challenges'));
    }

    public function create(): View
    {
        return view('challenges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'required|integer|min:1',
            'due_date' => 'required|date|after:today',
            'difficulty' => 'required|in:easy,medium,hard'
        ]);

        $validated['teacher_id'] = auth()->id();

        Challenge::create($validated);

        return redirect()->route('challenges.index')
            ->with('success', 'Challenge created successfully.');
    }

    public function progress(): View
    {
        $challenges = Challenge::where('teacher_id', auth()->id())
            ->with(['submissions' => function ($query) {
                $query->with('student');
            }])
            ->get();

        return view('challenges.progress', compact('challenges'));
    }

    // ... other CRUD methods ...
} 