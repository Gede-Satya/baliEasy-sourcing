<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\SourcingProject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectTrackingController extends Controller
{
    public function show(string $token): View
    {
        $project = SourcingProject::where('access_token', $token)
            ->with(['category', 'quotation'])
            ->firstOrFail();

        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->orderBy('sort_order')->take(4)->get();

        return view('projects.tracking', compact('project', 'settings', 'categories'));
    }
}
