<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Models\ProductCategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class ProductCategoryDetailsController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'image.max'   => 'The image must not be larger than 2 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'product/details';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:product-category-details.view', only: ['index']),
            new Middleware('permission:product-category-details.create', only: ['create', 'store']),
            new Middleware('permission:product-category-details.edit', only: ['edit', 'update']),
            new Middleware('permission:product-category-details.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $details = ProductCategoryDetail::with('productCategory')->orderByDesc('id')->get();

        return view('backend.product.details.index', compact('details'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('name')->get();

        return view('backend.product.details.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'image'               => 'nullable|' . self::IMAGE_RULES,
        ], self::IMAGE_MESSAGES + [
            'product_category_id.required' => 'Please choose a product category.',
            'name.required'                => 'Please enter a name.',
        ]);

        ProductCategoryDetail::create([
            'product_category_id' => $request->product_category_id,
            'name'                => $request->name,
            'image'               => $this->storeImage($request),
            'slug'                => $this->uniqueSlug($request->name),
        ]);

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail added successfully.');
    }

    public function edit($id)
    {
        $detail     = ProductCategoryDetail::findOrFail($id);
        $categories = ProductCategory::where('is_active', true)
            ->orWhere('id', $detail->product_category_id)
            ->orderBy('name')->get();

        return view('backend.product.details.edit', compact('detail', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $detail = ProductCategoryDetail::findOrFail($id);

        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'image'               => 'nullable|' . self::IMAGE_RULES,
        ], self::IMAGE_MESSAGES + [
            'product_category_id.required' => 'Please choose a product category.',
            'name.required'                => 'Please enter a name.',
        ]);

        $slug = $detail->slug;
        if ($request->name !== $detail->name || empty($slug)) {
            $slug = $this->uniqueSlug($request->name, $detail->id);
        }

        // Replace the image only when a new one is uploaded; otherwise keep the existing file.
        $image = $detail->image;
        if ($request->hasFile('image')) {
            $this->deleteImage($detail->image);
            $image = $this->storeImage($request);
        }

        $detail->update([
            'product_category_id' => $request->product_category_id,
            'name'                => $request->name,
            'image'               => $image,
            'slug'                => $slug,
        ]);

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail updated successfully.');
    }

    public function destroy($id)
    {
        $detail = ProductCategoryDetail::findOrFail($id);
        $this->deleteImage($detail->image);
        $detail->delete();

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail deleted successfully.');
    }

    /** Move the uploaded image into /public/product/details and return its filename. */
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
            $base = 'product-detail-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            ProductCategoryDetail::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
