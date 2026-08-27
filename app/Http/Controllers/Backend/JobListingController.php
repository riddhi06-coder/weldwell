<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class JobListingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:job-listings.view', only: ['index']),
            new Middleware('permission:job-listings.create', only: ['create', 'store']),
            new Middleware('permission:job-listings.edit', only: ['edit', 'update']),
            new Middleware('permission:job-listings.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $jobs = JobListing::orderByDesc('id')->get();

        return view('backend.careers.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('backend.careers.jobs.create');
    }

    public function store(Request $request)
    {
        JobListing::create($this->validated($request));

        return redirect()->route('manage-job-listing.index')
            ->with('message', 'Job listing created successfully.');
    }

    public function edit(JobListing $manage_job_listing)
    {
        $job = $manage_job_listing;

        return view('backend.careers.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $manage_job_listing)
    {
        $manage_job_listing->update($this->validated($request));

        return redirect()->route('manage-job-listing.index')
            ->with('message', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $manage_job_listing)
    {
        $manage_job_listing->delete();

        return redirect()->route('manage-job-listing.index')
            ->with('message', 'Job listing deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'role_name'   => ['required', 'string', 'max:255'],
            'location'    => ['required', 'string', 'max:255'],
            'job_type'    => ['required', Rule::in(JobListing::TYPES)],
            'description' => ['required', 'string'],
            'is_active'   => ['required', 'boolean'],
        ]);

        return $data;
    }
}
