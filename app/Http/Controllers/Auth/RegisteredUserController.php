<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Set default role
        ]);

        // Initialize user's experience and level
        $user->experience = 0;
        $user->save();

        // Create initial level entry if using the level-up package
        if (class_exists('LevelUp\Experience\Models\Level')) {
            $level = \LevelUp\Experience\Models\Level::firstOrCreate(
                ['level' => 1],
                ['next_level_experience' => 100]
            );
            
            DB::table(config('level-up.table'))->insert([
                config('level-up.user.foreign_key') => $user->id,
                'level_id' => $level->id,
                'experience_points' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
