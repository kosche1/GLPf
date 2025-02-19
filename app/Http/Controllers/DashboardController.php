<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->hasRole('superadmin')) {
            return view('dashboard.superadmin');
        } elseif (auth()->user()->hasRole('admin')) {
            return view('dashboard.admin');
        } elseif (auth()->user()->hasRole('teacher')) {
            return view('dashboard.teacher');
        } elseif (auth()->user()->hasRole('student')) {
            return view('dashboard.student');
        }
        
        return view('dashboard');
    }
} 