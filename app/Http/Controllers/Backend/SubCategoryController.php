<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class SubCategoryController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'image.max'   => 'The image must not be larger than 2 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'brand/subcategory';

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
            'main_category_id' => 'required|exists:brand_categories,id',
            'name'             => 'required|string|max:255',
            'image'            => 'nullable|' . self::IMAGE_RULES,
        ], self::IMAGE_MESSAGES + [
            'main_category_id.required' => 'Please choose a parent category.',
            'name.required'             => 'Please enter a sub category name.',
        ]);

        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'name'             => $request->name,
            'image'            => $this->storeImage($request),
            'slug'             => $this->uniqueSlug($request->name),
        ]);

        return redirect()->route('manage-brand-list.index')->with('message', 'Brand added successfully.');
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
            'main_category_id' => 'required|exists:brand_categories,id',
            'name'             => 'required|string|max:255',
            'image'            => 'nullable|' . self::IMAGE_RULES,
        ], self::IMAGE_MESSAGES + [
            'main_category_id.required' => 'Please choose a parent category.',
            'name.required'             => 'Please enter a sub category name.',
        ]);

        $slug = $subCategory->slug;
        if ($request->name !== $subCategory->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $subCategory->id);
        }

        // Replace the image only when a new one is uploaded; otherwise keep the existing file.
        $image = $subCategory->image;
        if ($request->hasFile('image')) {
            $this->deleteImage($subCategory->image);
            $image = $this->storeImage($request);
        }

        $subCategory->update([
            'main_category_id' => $request->main_category_id,
            'name'             => $request->name,
            'image'            => $image,
            'slug'             => $slug,
        ]);

        return redirect()->route('manage-brand-list.index')->with('message', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('manage-brand-list.index')->with('message', 'Brand deleted successfully.');
    }

    /** Move the uploaded image into /public/brand/subcategory and return its filename. */
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
