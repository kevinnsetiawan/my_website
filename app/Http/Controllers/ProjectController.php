<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function home()
    {
        $projects = \App\Models\Project::latest()->take(3)->get();
        return view('home', compact('projects'));
    }

    public function index()
    {
        $projects = \App\Models\Project::latest()->get();
        return view('projects.index', compact('projects'));
    }
}
