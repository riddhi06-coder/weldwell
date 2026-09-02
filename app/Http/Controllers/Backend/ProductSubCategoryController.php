<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductSubCategoryController extends Controller
{

    public function index()
    {
        // Flat list; the view groups by product category via DataTables RowGroup.
        $subCategories = ProductSubCategory::with('productCategory')->orderBy('name')->get();

        return view('backend.product.sub_category.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('name')->get();

        return view('backend.product.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'short_description'   => 'nullable|string',
            'is_active'           => 'nullable|boolean',
        ], [
            'product_category_id.required' => 'Please choose a product category.',
            'name.required'                => 'Please enter a sub category name.',
        ]);

        ProductSubCategory::create([
            'product_category_id' => $request->product_category_id,
            'name'                => $request->name,
            'short_description'   => $request->short_description,
            'slug'                => $this->uniqueSlug($request->name),
            'is_active'           => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-product-subcategory.index')->with('message', 'Product sub category added successfully.');
    }

    public function edit($id)
    {
        $subCategory = ProductSubCategory::findOrFail($id);

        // Active categories, plus this record's own category even if it's now inactive.
        $categories = ProductCategory::where('is_active', true)
            ->orWhere('id', $subCategory->product_category_id)
            ->orderBy('name')->get();

        return view('backend.product.sub_category.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = ProductSubCategory::findOrFail($id);

        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'short_description'   => 'nullable|string',
            'is_active'           => 'nullable|boolean',
        ], [
            'product_category_id.required' => 'Please choose a product category.',
            'name.required'                => 'Please enter a sub category name.',
        ]);

        // Regenerate the slug only when the name changes (keeps existing slugs stable).
        $slug = $subCategory->slug;
        if ($request->name !== $subCategory->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $subCategory->id);
        }

        $subCategory->update([
            'product_category_id' => $request->product_category_id,
            'name'                => $request->name,
            'short_description'   => $request->short_description,
            'slug'                => $slug,
            'is_active'           => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-product-subcategory.index')->with('message', 'Product sub category updated successfully.');
    }

    public function destroy($id)
    {
        ProductSubCategory::findOrFail($id)->delete();

        return redirect()->route('manage-product-subcategory.index')->with('message', 'Product sub category deleted successfully.');
    }

    /**
     * Build a URL-safe, unique slug from the given name.
     */
    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'product-sub-category-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            ProductSubCategory::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

}