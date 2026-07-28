<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductIntro;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductIntroController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:product-intros.view', only: ['index']),
            new Middleware('permission:product-intros.create', only: ['create', 'store']),
            new Middleware('permission:product-intros.edit', only: ['edit', 'update']),
            new Middleware('permission:product-intros.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $intros = ProductIntro::withCount('qualities')->orderByDesc('id')->get();

        return view('backend.home.product_intro.index', compact('intros'));
    }

    public function create()
    {
        // Only one product intro is allowed — send them to edit the existing one.
        if ($intro = ProductIntro::first()) {
            return redirect()->route('manage-product-intro.edit', $intro->id)
                ->with('message', 'Only one product introduction is allowed. You can edit the existing one.');
        }

        return view('backend.home.product_intro.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second product intro.
        if (ProductIntro::exists()) {
            return redirect()->route('manage-product-intro.index')
                ->with('message', 'A product introduction already exists. Only one is allowed.');
        }

        $data = $this->validated($request);

        $intro = ProductIntro::create([
            'heading'     => $data['heading'],
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ]);

        $this->syncQualities($intro, $request);

        return redirect()->route('manage-product-intro.index')->with('message', 'Product introduction added successfully.');
    }

    public function edit($id)
    {
        $intro = ProductIntro::with('qualities')->findOrFail($id);

        return view('backend.home.product_intro.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {
        $intro = ProductIntro::findOrFail($id);

        $data = $this->validated($request);

        $intro->update([
            'heading'     => $data['heading'],
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ]);

        $this->syncQualities($intro, $request);

        return redirect()->route('manage-product-intro.index')->with('message', 'Product introduction updated successfully.');
    }

    public function destroy($id)
    {
        $intro = ProductIntro::findOrFail($id);
        // ProductIntro is soft-deleted, so the DB FK cascade won't fire — remove qualities explicitly.
        $intro->qualities()->delete();
        $intro->delete();

        return redirect()->route('manage-product-intro.index')->with('message', 'Product introduction deleted successfully.');
    }

    /** Shared validation for store/update. */
    private function validated(Request $request): array
    {
        return $request->validate([
            'heading'     => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'qualities'   => 'nullable|array',
            'qualities.*' => 'nullable|string|max:255',
        ], [
            'heading.required' => 'Please enter the heading.',
            'title.required'   => 'Please enter the title.',
        ]);
    }

    /** Replace the intro's qualities with the submitted rows (blank rows are skipped). */
    private function syncQualities(ProductIntro $intro, Request $request): void
    {
        $intro->qualities()->delete();

        $order = 0;
        foreach ((array) $request->input('qualities', []) as $quality) {
            $quality = trim((string) $quality);
            if ($quality === '') {
                continue;
            }

            $intro->qualities()->create([
                'quality'    => $quality,
                'sort_order' => $order++,
            ]);
        }
    }
}
