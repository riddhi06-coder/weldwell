<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'image.max'   => 'The image must not be larger than 2 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'product/category';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:product-categories.view', only: ['index']),
            new Middleware('permission:product-categories.create', only: ['create', 'store']),
            new Middleware('permission:product-categories.edit', only: ['edit', 'update']),
            new Middleware('permission:product-categories.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = ProductCategory::orderByDesc('id')->get();

        return view('backend.product.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.product.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|' . self::IMAGE_RULES,
            'is_active' => 'nullable|boolean',
        ], self::IMAGE_MESSAGES + [
            'name.required' => 'Please enter a category name.',
        ]);

        ProductCategory::create([
            'name'      => $request->name,
            'title'     => $request->title,
            'image'     => $this->storeImage($request),
            'slug'      => $this->uniqueSlug($request->name),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-product-category.index')->with('message', 'Product category added successfully.');
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('backend.product.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|' . self::IMAGE_RULES,
            'is_active' => 'nullable|boolean',
        ], self::IMAGE_MESSAGES + [
            'name.required' => 'Please enter a category name.',
        ]);

        // Regenerate the slug only when the name changes (keeps existing slugs stable).
        $slug = $category->slug;
        if ($request->name !== $category->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $category->id);
        }

        // Replace the image only when a new one is uploaded.
        $image = $category->image;
        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);
            $image = $this->storeImage($request);
        }

        $category->update([
            'name'      => $request->name,
            'title'     => $request->title,
            'image'     => $image,
            'slug'      => $slug,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-product-category.index')->with('message', 'Product category updated successfully.');
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $this->deleteImage($category->image);
        $category->delete();

        return redirect()->route('manage-product-category.index')->with('message', 'Product category deleted successfully.');
    }

    /** Move the uploaded image into /public/product/category and return its filename. */
    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file   = $request->file('image');
        $folder = public_path(self::UPLOAD_DIR);

        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return $fileName;
    }

    private function deleteImage(?string $fileName): void
    {
        if ($fileName && file_exists(public_path(self::UPLOAD_DIR . '/' . $fileName))) {
            @unlink(public_path(self::UPLOAD_DIR . '/' . $fileName));
        }
    }

    /**
     * Build a URL-safe, unique slug from the given name.
     */
    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'product-category-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            ProductCategory::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
