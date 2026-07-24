<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class MasterBrandController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:brand-categories.view', only: ['index']),
            new Middleware('permission:brand-categories.create', only: ['create', 'store']),
            new Middleware('permission:brand-categories.edit', only: ['edit', 'update']),
            new Middleware('permission:brand-categories.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = MainCategory::orderByDesc('id')->get();

        return view('backend.brand.main_category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.brand.main_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please enter a category name.',
        ]);

        MainCategory::create([
            'name' => $request->name,
            'slug' => $this->uniqueSlug($request->name),
        ]);

        return redirect()->route('manage-brand-catgeory.index')->with('message', 'Brand category added successfully.');
    }

    public function edit($id)
    {
        $category = MainCategory::findOrFail($id);

        return view('backend.brand.main_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = MainCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please enter a category name.',
        ]);

        // Regenerate the slug only when the name changes (keeps existing slugs stable).
        $slug = $category->slug;
        if ($request->name !== $category->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $category->id);
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('manage-brand-catgeory.index')->with('message', 'Brand category updated successfully.');
    }

    public function destroy($id)
    {
        $category = MainCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('manage-brand-catgeory.index')->with('message', 'Brand category deleted successfully.');
    }

    /**
     * Build a URL-safe, unique slug from the given name.
     */
    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'category-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            MainCategory::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
