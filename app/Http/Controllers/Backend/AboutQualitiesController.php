<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutQuality;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AboutQualitiesController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'about/qualities';

    /** The image fields this section carries. */
    private const IMAGE_FIELDS = ['image', 'background_image'];

    public static function middleware(): array
    {
        return [
            new Middleware('permission:about-qualities.view', only: ['index']),
            new Middleware('permission:about-qualities.create', only: ['create', 'store']),
            new Middleware('permission:about-qualities.edit', only: ['edit', 'update']),
            new Middleware('permission:about-qualities.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $qualities = AboutQuality::withCount('values')->orderByDesc('id')->get();

        return view('backend.about.qualities.index', compact('qualities'));
    }

    public function create()
    {
        // Only one ACTIVE record may exist at a time. While one is active, send them to
        // edit it; once it's deactivated (or none exists) they can add a new one.
        if ($active = AboutQuality::where('is_active', true)->first()) {
            return redirect()->route('manage-about-qualities.edit', $active->id)
                ->with('message', 'An active record already exists. Edit it, or deactivate it to add a new one.');
        }

        return view('backend.about.qualities.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second ACTIVE record (inactive ones may coexist).
        if (AboutQuality::where('is_active', true)->exists()) {
            return redirect()->route('manage-about-qualities.index')
                ->with('message', 'An active record already exists. Only one active record is allowed.');
        }

        $data = $this->validated($request, isUpdate: false);

        $quality = AboutQuality::create([
            'heading'          => $data['heading'] ?? null,
            'image'            => $this->storeImage($request, 'image'),
            'background_image' => $this->storeImage($request, 'background_image'),
            'more_info_desc'   => $data['more_info_desc'] ?? null,
            'youtube_link'     => $data['youtube_link'] ?? null,
            'statement'        => $data['statement'] ?? null,
            'is_active'        => $request->boolean('is_active'),
        ]);

        $this->syncValues($quality, $request);

        return redirect()->route('manage-about-qualities.index')->with('message', 'Core qualities added successfully.');
    }

    public function edit($id)
    {
        $quality = AboutQuality::with('values')->findOrFail($id);

        return view('backend.about.qualities.edit', compact('quality'));
    }

    public function update(Request $request, $id)
    {
        $quality = AboutQuality::findOrFail($id);

        $data = $this->validated($request, isUpdate: true);

        // Replace each image only when a new one is uploaded; otherwise keep the existing file.
        $images = [];
        foreach (self::IMAGE_FIELDS as $field) {
            if ($request->hasFile($field)) {
                $this->deleteImage($quality->{$field});
                $images[$field] = $this->storeImage($request, $field);
            } else {
                $images[$field] = $quality->{$field};
            }
        }

        $quality->update([
            'heading'          => $data['heading'] ?? null,
            'image'            => $images['image'],
            'background_image' => $images['background_image'],
            'more_info_desc'   => $data['more_info_desc'] ?? null,
            'youtube_link'     => $data['youtube_link'] ?? null,
            'statement'        => $data['statement'] ?? null,
            'is_active'        => $request->boolean('is_active'),
        ]);

        $this->syncValues($quality, $request);

        return redirect()->route('manage-about-qualities.index')->with('message', 'Core qualities updated successfully.');
    }

    public function destroy($id)
    {
        $quality = AboutQuality::findOrFail($id);
        $userId  = Auth::id();

        // Soft-delete only — nothing is physically removed and the image files are kept
        // on disk so the record can be fully restored later.

        // Children: flag deleted_at + deleted_by in a single update (they use SoftDeletes).
        $quality->values()->update([
            'deleted_at' => now(),
            'deleted_by' => $userId,
        ]);

        // Parent: soft-delete (audited as "deleted"), then stamp who did it via a raw
        // update so it doesn't generate a second audit entry.
        $quality->delete();
        AboutQuality::withTrashed()->whereKey($quality->id)->update(['deleted_by' => $userId]);

        return redirect()->route('manage-about-qualities.index')->with('message', 'Core qualities deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    /** Shared validation for store/update. The header image is required only when creating. */
    private function validated(Request $request, bool $isUpdate): array
    {
        return $request->validate([
            'heading'                 => 'nullable|string',
            'image'                   => ($isUpdate ? 'nullable|' : 'required|') . self::IMAGE_RULES,
            'background_image'        => 'nullable|' . self::IMAGE_RULES,
            'more_info_desc'          => 'nullable|string',
            'youtube_link'            => 'nullable|string|max:500',
            'statement'               => 'nullable|string',
            'values'                  => 'nullable|array',
            'values.*.value_name'     => 'nullable|string|max:255',
            'values.*.description'    => 'nullable|string',
        ], [
            'image.required'          => 'Please upload the header image.',
            'image.image'             => 'The header image must be a valid image.',
            'image.mimes'             => 'The header image must be JPG, PNG or WebP.',
            'image.max'               => 'The header image must not be larger than 2 MB.',
            'background_image.image'  => 'The background image must be a valid image.',
            'background_image.mimes'  => 'The background image must be JPG, PNG or WebP.',
            'background_image.max'    => 'The background image must not be larger than 2 MB.',
        ]);
    }

    /** Replace the record's core-value rows (blank rows are skipped). */
    private function syncValues(AboutQuality $quality, Request $request): void
    {
        $quality->values()->delete();

        $order = 0;
        foreach ((array) $request->input('values', []) as $row) {
            $name        = trim((string) ($row['value_name'] ?? ''));
            $description = trim((string) ($row['description'] ?? ''));

            // Skip fully-empty rows.
            if ($name === '' && $description === '') {
                continue;
            }

            $quality->values()->create([
                'value_name'  => $name,
                'description' => $description !== '' ? $description : null,
                'sort_order'  => $order++,
            ]);
        }
    }

    /** Move an uploaded image into /public/about/qualities and return its filename. */
    private function storeImage(Request $request, string $field): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file   = $request->file($field);
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
}
