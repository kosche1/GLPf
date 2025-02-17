<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use LevelUp\Experience\Models\Experience;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('level')
            ->withCount([
                'experiences as users_count' => function($query) {
                    $query->select(\DB::raw('count(distinct user_id)'));
                }
            ])
            ->get();
            
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|integer|unique:levels,level',
            'next_level_experience' => 'nullable|integer|min:0',
        ]);

        Level::create($validated);

        return redirect()->route('levels.index')
            ->with('success', 'Level created successfully.');
    }

    public function edit(Level $level)
    {
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'level' => 'required|integer|unique:levels,level,' . $level->id,
            'next_level_experience' => 'nullable|integer|min:0',
        ]);

        $level->update($validated);

        return redirect()->route('levels.index')
            ->with('success', 'Level updated successfully.');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.index')
            ->with('success', 'Level deleted successfully.');
    }
} 