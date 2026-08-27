<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Models\ProductCategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class ProductCategoryDetailsController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'banner_image.image' => 'The banner must be an image.',
        'banner_image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'banner_image.max'   => 'The banner image must not be larger than 2 MB.',
        'section_image.image' => 'The section image must be an image.',
        'section_image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'section_image.max'   => 'The section image must not be larger than 2 MB.',
        'knowledge_background_image.image' => 'The background must be an image.',
        'knowledge_background_image.mimes' => 'Only JPG, PNG or WebP images are allowed.',
        'knowledge_background_image.max'   => 'The background image must not be larger than 2 MB.',
    ];

    /** Per-field upload folders under /public (images + documents). */
    private const DIRS = [
        'banner_image'               => 'product/details/banner',
        'section_image'              => 'product/details/section',
        'knowledge_background_image' => 'product/details/knowledge',
        'knowledge_certificate'      => 'product/details/certificates',
        'knowledge_brochure'         => 'product/details/brochures',
    ];

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
        $data = $this->validated($request, imagesRequired: true);

        $detail = ProductCategoryDetail::create($this->payload($request, [
            'banner_image'               => $this->storeImage($request, 'banner_image'),
            'section_image'              => $this->storeImage($request, 'section_image'),
            'knowledge_background_image' => $this->storeImage($request, 'knowledge_background_image'),
            'knowledge_certificate'      => $this->storeImage($request, 'knowledge_certificate'),
            'knowledge_brochure'         => $this->storeImage($request, 'knowledge_brochure'),
        ]));

        $this->syncChildren($detail, $request);

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail added successfully.');
    }

    public function edit($id)
    {
        $detail     = ProductCategoryDetail::with(['features', 'industries'])->findOrFail($id);
        $categories = ProductCategory::where('is_active', true)
            ->orWhere('id', $detail->product_category_id)
            ->orderBy('name')->get();

        return view('backend.product.details.edit', compact('detail', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $detail = ProductCategoryDetail::findOrFail($id);

        $this->validated($request, imagesRequired: false, ignoreId: $detail->id);

        // Replace each image only when a new one is uploaded; otherwise keep the existing file.
        $images = [];
        foreach (array_keys(self::DIRS) as $field) {
            $images[$field] = $detail->{$field};
            if ($request->hasFile($field)) {
                $this->deleteImage($field, $detail->{$field});
                $images[$field] = $this->storeImage($request, $field);
            }
        }

        $detail->update($this->payload($request, $images));

        $this->syncChildren($detail, $request);

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail updated successfully.');
    }

    public function destroy($id)
    {
        $detail = ProductCategoryDetail::findOrFail($id);

        foreach (array_keys(self::DIRS) as $field) {
            $this->deleteImage($field, $detail->{$field});
        }

        $detail->delete(); // children cascade via FK

        return redirect()->route('manage-product-category-details.index')->with('message', 'Product detail deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    /** Shared validation for store/update. Images are required on create only. */
    private function validated(Request $request, bool $imagesRequired, ?int $ignoreId = null): array
    {
        $img = ($imagesRequired ? 'required|' : 'nullable|') . self::IMAGE_RULES;
        // Documents (certificate, brochure) are always optional, PDF/Word up to 5 MB.
        // Explicit mime types so both .doc (application/msword) and .docx pass reliably.
        $doc = 'nullable|file|max:5120|mimetypes:application/pdf,application/msword,'
            . 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,'
            . 'application/vnd.ms-office,application/x-cfb';

        // One detail record per product category (soft-deleted rows don't count;
        // the current record is ignored on edit).
        $uniqueCategory = Rule::unique('product_category_details', 'product_category_id')
            ->whereNull('deleted_at')
            ->ignore($ignoreId);

        return $request->validate([
            'product_category_id'   => ['required', 'exists:product_categories,id', $uniqueCategory],

            'banner_image'          => $img,
            'banner_description'    => 'required|string',

            'section_heading'       => 'required|string|max:255',
            'section_image'         => $img,
            'section_description'   => 'required|string',

            'product_range_title'   => 'required|string|max:255',
            'product_range_heading' => 'required|string|max:255',

            'knowledge_title'              => 'required|string|max:255',
            'knowledge_heading'            => 'required|string|max:255',
            'knowledge_description'        => 'required|string',
            'knowledge_background_image'   => $img,
            'knowledge_certificate'        => $doc,
            'knowledge_brochure'           => $doc,
            'knowledge_map_url'            => 'nullable|string|max:2000',

            'industries_title'      => 'required|string|max:255',
            'industries_heading'    => 'required|string|max:255',

            'media_title'           => 'required|string|max:255',
            'media_heading'         => 'required|string|max:255',
            'media_description'     => 'required|string',
            'media_youtube_url'     => 'required|string|max:2000',

            // Features table (number + description) — at least one row, all cells required.
            'feature_number'        => 'required|array|min:1',
            'feature_number.*'      => 'required|string|max:255',
            'feature_description'   => 'required|array|min:1',
            'feature_description.*' => 'required|string|max:1000',

            // Industries table — at least one row, all cells required.
            'industry_name'         => 'required|array|min:1',
            'industry_name.*'       => 'required|string|max:255',
        ], self::IMAGE_MESSAGES + [
            'product_category_id.required'  => 'Please choose a product category.',
            'product_category_id.unique'    => 'A detail record for this product category already exists.',
            'feature_number.required'       => 'Add at least one feature row.',
            'industry_name.required'        => 'Add at least one industry row.',
            'knowledge_certificate.mimetypes' => 'Certificate must be a PDF or Word (.doc/.docx) file.',
            'knowledge_certificate.max'       => 'Certificate must not be larger than 5 MB.',
            'knowledge_brochure.mimetypes'    => 'Brochure must be a PDF or Word (.doc/.docx) file.',
            'knowledge_brochure.max'          => 'Brochure must not be larger than 5 MB.',
        ]);
    }

    /** Build the model attribute array from the request + resolved image filenames. */
    private function payload(Request $request, array $images): array
    {
        return array_merge([
            'product_category_id'   => $request->product_category_id,
            'banner_description'    => $request->banner_description,
            'section_heading'       => $request->section_heading,
            'section_description'   => $request->section_description,
            'product_range_title'   => $request->product_range_title,
            'product_range_heading' => $request->product_range_heading,
            'knowledge_title'       => $request->knowledge_title,
            'knowledge_heading'     => $request->knowledge_heading,
            'knowledge_description' => $request->knowledge_description,
            'knowledge_map_url'     => $request->knowledge_map_url,
            'industries_title'      => $request->industries_title,
            'industries_heading'    => $request->industries_heading,
            'media_title'           => $request->media_title,
            'media_heading'         => $request->media_heading,
            'media_description'     => $request->media_description,
            'media_youtube_url'     => $request->media_youtube_url,
            'is_active'             => $request->boolean('is_active'),
        ], $images);
    }

    /** Rebuild both repeater relations (delete-then-recreate, blank rows skipped). */
    private function syncChildren(ProductCategoryDetail $detail, Request $request): void
    {
        $numbers      = $request->input('feature_number', []);
        $descriptions = $request->input('feature_description', []);
        $detail->features()->delete();
        $order = 0;
        foreach ($numbers as $i => $number) {
            $number      = trim((string) $number);
            $description = trim((string) ($descriptions[$i] ?? ''));
            if ($number === '' && $description === '') {
                continue;
            }
            $detail->features()->create([
                'number'      => $number,
                'description' => $description,
                'sort_order'  => $order++,
            ]);
        }

        $detail->industries()->delete();
        $order = 0;
        foreach ($request->input('industry_name', []) as $name) {
            $name = trim((string) $name);
            if ($name === '') {
                continue;
            }
            $detail->industries()->create([
                'name'       => $name,
                'sort_order' => $order++,
            ]);
        }
    }

    /** Move an uploaded file for the given field into its folder and return the filename. */
    private function storeImage(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file   = $request->file($field);
        $folder = public_path(self::DIRS[$field]);

        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return $fileName;
    }

    private function deleteImage(string $field, ?string $fileName): void
    {
        if ($fileName && file_exists(public_path(self::DIRS[$field] . '/' . $fileName))) {
            @unlink(public_path(self::DIRS[$field] . '/' . $fileName));
        }
    }
}
