<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Event;
use App\Models\MainCategory;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Live counts for the dashboard stat cards. Each card is permission-gated
     * in the view, so we only compute what's cheap and show what the user can see.
     */
    public function index()
    {
        $stats = [
            'users'           => User::count(),
            'roles'           => Role::count(),
            'brandCategories' => MainCategory::count(),
            'subCategories'   => SubCategory::count(),
            'testimonials'    => Testimonial::count(),
            'events'          => Event::count(),
            'activityLogs'    => ActivityLog::count(),
        ];

        return view('backend.dashboard', compact('stats'));
    }
}
