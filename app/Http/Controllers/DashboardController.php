<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        // Ensure the role exists, default to student if not
        $validRoles = ['student', 'admin', 'superadmin'];
        $role = in_array($user->role, $validRoles) ? $user->role : 'student';
        
        return view("dashboard.{$role}", [
            'user' => $user,
        ]);
    }
} 