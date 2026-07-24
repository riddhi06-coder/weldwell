<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class SubCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:brand-subcategories.view', only: ['index']),
            new Middleware('permission:brand-subcategories.create', only: ['create', 'store']),
            new Middleware('permission:brand-subcategories.edit', only: ['edit', 'update']),
            new Middleware('permission:brand-subcategories.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $subCategories = SubCategory::with('mainCategory')->orderByDesc('id')->get();

        return view('backend.brand.sub_category.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = MainCategory::where('is_active', true)->orderBy('name')->get();

        return view('backend.brand.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'name'             => 'required|string|max:255',
        ], [
            'main_category_id.required' => 'Please choose a parent category.',
            'name.required'             => 'Please enter a sub category name.',
        ]);

        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'name'             => $request->name,
            'slug'             => $this->uniqueSlug($request->name),
        ]);

        return redirect()->route('manage-brand-subcategory.index')->with('message', 'Sub category added successfully.');
    }

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories  = MainCategory::where('is_active', true)
            ->orWhere('id', $subCategory->main_category_id)
            ->orderBy('name')->get();

        return view('backend.brand.sub_category.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'name'             => 'required|string|max:255',
        ], [
            'main_category_id.required' => 'Please choose a parent category.',
            'name.required'             => 'Please enter a sub category name.',
        ]);

        $slug = $subCategory->slug;
        if ($request->name !== $subCategory->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $subCategory->id);
        }

        $subCategory->update([
            'main_category_id' => $request->main_category_id,
            'name'             => $request->name,
            'slug'             => $slug,
        ]);

        return redirect()->route('manage-brand-subcategory.index')->with('message', 'Sub category updated successfully.');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('manage-brand-subcategory.index')->with('message', 'Sub category deleted successfully.');
    }

    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'sub-category-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            SubCategory::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
