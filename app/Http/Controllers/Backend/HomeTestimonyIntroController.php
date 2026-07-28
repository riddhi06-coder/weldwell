<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TestimonyIntro;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeTestimonyIntroController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:testimony-intros.view', only: ['index']),
            new Middleware('permission:testimony-intros.create', only: ['create', 'store']),
            new Middleware('permission:testimony-intros.edit', only: ['edit', 'update']),
            new Middleware('permission:testimony-intros.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $intros = TestimonyIntro::withCount('sliders')->orderByDesc('id')->get();

        return view('backend.home.testimony_intro.index', compact('intros'));
    }

    public function create()
    {
        // Only one testimony intro is allowed — send them to edit the existing one.
        if ($intro = TestimonyIntro::first()) {
            return redirect()->route('manage-testimony-intro.edit', $intro->id)
                ->with('message', 'Only one testimony introduction is allowed. You can edit the existing one.');
        }

        return view('backend.home.testimony_intro.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second testimony intro.
        if (TestimonyIntro::exists()) {
            return redirect()->route('manage-testimony-intro.index')
                ->with('message', 'A testimony introduction already exists. Only one is allowed.');
        }

        $data = $this->validated($request);

        $intro = TestimonyIntro::create([
            'heading'   => $data['heading'],
            'title'     => $data['title'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncSliders($intro, $request);

        return redirect()->route('manage-testimony-intro.index')->with('message', 'Testimony introduction added successfully.');
    }

    public function edit($id)
    {
        $intro = TestimonyIntro::with('sliders')->findOrFail($id);

        return view('backend.home.testimony_intro.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {
        $intro = TestimonyIntro::findOrFail($id);

        $data = $this->validated($request);

        $intro->update([
            'heading'   => $data['heading'],
            'title'     => $data['title'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncSliders($intro, $request);

        return redirect()->route('manage-testimony-intro.index')->with('message', 'Testimony introduction updated successfully.');
    }

    public function destroy($id)
    {
        $intro = TestimonyIntro::findOrFail($id);
        // TestimonyIntro is soft-deleted, so the DB FK cascade won't fire — remove sliders explicitly.
        $intro->sliders()->delete();
        $intro->delete();

        return redirect()->route('manage-testimony-intro.index')->with('message', 'Testimony introduction deleted successfully.');
    }

    /** Shared validation for store/update. */
    private function validated(Request $request): array
    {
        return $request->validate([
            'heading'    => 'required|string|max:255',
            'title'      => 'nullable|string',
            'sliders'    => 'nullable|array',
            'sliders.*'  => 'nullable|string|max:255',
        ], [
            'heading.required' => 'Please enter the heading.',
        ]);
    }

    /** Replace the intro's slider rows with the submitted ones (blank rows are skipped). */
    private function syncSliders(TestimonyIntro $intro, Request $request): void
    {
        $intro->sliders()->delete();

        $order = 0;
        foreach ((array) $request->input('sliders', []) as $title) {
            $title = trim((string) $title);
            if ($title === '') {
                continue;
            }

            $intro->sliders()->create([
                'title'      => $title,
                'sort_order' => $order++,
            ]);
        }
    }
}
