<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CareerPageDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CareerPageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:career-page-details.view', only: ['index']),
            new Middleware('permission:career-page-details.create', only: ['create', 'store']),
            new Middleware('permission:career-page-details.edit', only: ['edit', 'update']),
            new Middleware('permission:career-page-details.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $details = CareerPageDetail::withCount('benefits')->orderByDesc('id')->get();

        return view('backend.careers.page_details.index', compact('details'));
    }

    public function create()
    {
        // Only one record is allowed — send them to edit the existing one.
        if ($detail = CareerPageDetail::first()) {
            return redirect()->route('manage-career-page-details.edit', $detail->id)
                ->with('message', 'Only one career page details record is allowed. You can edit the existing one.');
        }

        return view('backend.careers.page_details.create');
    }

    public function store(Request $request)
    {
        if (CareerPageDetail::exists()) {
            return redirect()->route('manage-career-page-details.index')
                ->with('message', 'Career page details already exist. Only one record is allowed.');
        }

        $this->validated($request);

        $detail = CareerPageDetail::create($this->payload($request));

        $this->syncBenefits($detail, $request);

        return redirect()->route('manage-career-page-details.index')->with('message', 'Career page details added successfully.');
    }

    public function edit($id)
    {
        $detail = CareerPageDetail::with('benefits')->findOrFail($id);

        return view('backend.careers.page_details.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = CareerPageDetail::findOrFail($id);

        $this->validated($request);

        $detail->update($this->payload($request));

        $this->syncBenefits($detail, $request);

        return redirect()->route('manage-career-page-details.index')->with('message', 'Career page details updated successfully.');
    }

    public function destroy($id)
    {
        $detail = CareerPageDetail::findOrFail($id);
        $detail->delete(); // benefits cascade via FK

        return redirect()->route('manage-career-page-details.index')->with('message', 'Career page details deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    private function validated(Request $request): array
    {
        return $request->validate([
            'banner_heading'      => 'required|string|max:255',
            'description'         => 'required|string',
            'section_heading'     => 'required|string|max:255',
            'career_heading'      => 'required|string|max:255',
            'title'               => 'required|string|max:255',

            // Benefits table — at least one row, all cells required.
            'benefit'             => 'required|array|min:1',
            'benefit.*'           => 'required|string|max:255',
            'benefit_description'   => 'required|array|min:1',
            'benefit_description.*' => 'required|string|max:1000',
        ], [
            'banner_heading.required'  => 'Please enter the banner heading.',
            'description.required'     => 'Please enter the description.',
            'section_heading.required' => 'Please enter the section heading.',
            'career_heading.required'  => 'Please enter the career heading.',
            'title.required'           => 'Please enter the title.',
            'benefit.required'         => 'Add at least one benefit row.',
        ]);
    }

    private function payload(Request $request): array
    {
        return [
            'banner_heading'  => $request->banner_heading,
            'description'     => $request->description,
            'section_heading' => $request->section_heading,
            'career_heading'  => $request->career_heading,
            'title'           => $request->title,
            'is_active'       => $request->boolean('is_active'),
        ];
    }

    /** Rebuild the benefits rows (delete-then-recreate, blank rows skipped). */
    private function syncBenefits(CareerPageDetail $detail, Request $request): void
    {
        $benefits     = $request->input('benefit', []);
        $descriptions = $request->input('benefit_description', []);

        $detail->benefits()->delete();

        $order = 0;
        foreach ($benefits as $i => $benefit) {
            $benefit     = trim((string) $benefit);
            $description = trim((string) ($descriptions[$i] ?? ''));
            if ($benefit === '' && $description === '') {
                continue;
            }
            $detail->benefits()->create([
                'benefit'     => $benefit,
                'description' => $description,
                'sort_order'  => $order++,
            ]);
        }
    }
}
