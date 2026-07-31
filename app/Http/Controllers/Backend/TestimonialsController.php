<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TestimonialsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:testimonials.view', only: ['index']),
            new Middleware('permission:testimonials.create', only: ['create', 'store']),
            new Middleware('permission:testimonials.edit', only: ['edit', 'update']),
            new Middleware('permission:testimonials.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $testimonials = Testimonial::orderByDesc('id')->get();

        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        Testimonial::create([
            'client_name'   => $request->client_name,
            'industry_type' => $request->industry_type,
            'testimony'     => $request->testimony,
            'is_active'     => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-testimonials.index')->with('message', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('backend.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate($this->rules(), $this->messages());

        $testimonial->update([
            'client_name'   => $request->client_name,
            'industry_type' => $request->industry_type,
            'testimony'     => $request->testimony,
            'is_active'     => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-testimonials.index')->with('message', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('manage-testimonials.index')->with('message', 'Testimonial deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'client_name'   => 'required|string|max:255',
            'industry_type' => 'required|string|max:255',
            'testimony'     => 'required|string',
        ];
    }

    private function messages(): array
    {
        return [
            'client_name.required'   => 'Please enter the client name.',
            'industry_type.required' => 'Please enter the industry type.',
            'testimony.required'     => 'Please enter the testimony.',
        ];
    }
}
