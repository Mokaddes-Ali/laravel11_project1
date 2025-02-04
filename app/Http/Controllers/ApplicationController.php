<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Show application form
    public function create()
    {
        return view('application.create');
    }

    // Store application
    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required|string',
        ]);

        Application::create([
            'user_id' => auth()->id(),
            'details' => $request->details,
        ]);

        return redirect()->route('application.create')->with('success', 'Application submitted successfully!');
    }

    // Show application details (for user)
    public function show(Application $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        return view('application.show', compact('application'));
    }

    // Admin: List all applications
    public function index()
    {
        $applications = Application::with('user')->get();
        return view('admin.applications.index', compact('applications'));
    }

    // Admin: Approve application
    public function approve(Application $application)
    {
        $application->update(['status' => 'approved']);
        return redirect()->route('admin.applications.index')->with('success', 'Application approved!');
    }
}
