<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AboutIntroController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'about/intro';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:about-intro.view', only: ['index']),
            new Middleware('permission:about-intro.create', only: ['create', 'store']),
            new Middleware('permission:about-intro.edit', only: ['edit', 'update']),
            new Middleware('permission:about-intro.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $intros = AboutIntro::withCount('visions')->orderByDesc('id')->get();

        return view('backend.about.intro.index', compact('intros'));
    }

    public function create()
    {
        // Only one ACTIVE introduction may exist at a time. While one is active, send
        // them to edit it; once it's deactivated (or none exists) they can add a new one.
        if ($active = AboutIntro::where('is_active', true)->first()) {
            return redirect()->route('manage-about-intro.edit', $active->id)
                ->with('message', 'An active introduction already exists. Edit it, or deactivate it to add a new one.');
        }

        return view('backend.about.intro.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second ACTIVE introduction (inactive ones may coexist).
        if (AboutIntro::where('is_active', true)->exists()) {
            return redirect()->route('manage-about-intro.index')
                ->with('message', 'An active introduction already exists. Only one active introduction is allowed.');
        }

        $data = $this->validated($request, isUpdate: false);

        $intro = AboutIntro::create([
            'heading'           => $data['heading'],
            'image'             => $this->storeImage($request),
            'introduction'      => $data['introduction'] ?? null,
            'motto_heading'     => $data['motto_heading'] ?? null,
            'motto_description' => $data['motto_description'] ?? null,
            'is_active'         => $request->boolean('is_active'),
        ]);

        $this->syncVisions($intro, $request);

        return redirect()->route('manage-about-intro.index')->with('message', 'Introduction added successfully.');
    }

    public function edit($id)
    {
        $intro = AboutIntro::with('visions')->findOrFail($id);

        return view('backend.about.intro.edit', compact('intro'));
    }

    public function update(Request $request, $id)
    {
        $intro = AboutIntro::findOrFail($id);

        $data = $this->validated($request, isUpdate: true);

        // Replace the image only when a new one is uploaded; otherwise keep the existing file.
        $image = $intro->image;
        if ($request->hasFile('image')) {
            $this->deleteImage($intro->image);
            $image = $this->storeImage($request);
        }

        $intro->update([
            'heading'           => $data['heading'],
            'image'             => $image,
            'introduction'      => $data['introduction'] ?? null,
            'motto_heading'     => $data['motto_heading'] ?? null,
            'motto_description' => $data['motto_description'] ?? null,
            'is_active'         => $request->boolean('is_active'),
        ]);

        $this->syncVisions($intro, $request);

        return redirect()->route('manage-about-intro.index')->with('message', 'Introduction updated successfully.');
    }

    public function destroy($id)
    {
        $intro  = AboutIntro::findOrFail($id);
        $userId = Auth::id();

        // Soft-delete only — nothing is physically removed and the image file is kept
        // on disk so the record can be fully restored later.

        // Children: flag deleted_at + deleted_by in a single update (they use SoftDeletes).
        $intro->visions()->update([
            'deleted_at' => now(),
            'deleted_by' => $userId,
        ]);

        // Parent: soft-delete (sets deleted_at, audited as "deleted"), then stamp who did it
        // via a raw update so it doesn't generate a second audit entry.
        $intro->delete();
        AboutIntro::withTrashed()->whereKey($intro->id)->update(['deleted_by' => $userId]);

        return redirect()->route('manage-about-intro.index')->with('message', 'Introduction deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    /** Shared validation for store/update. Image is required only when creating. */
    private function validated(Request $request, bool $isUpdate): array
    {
        return $request->validate([
            'heading'                => 'required|string|max:255',
            'image'                  => ($isUpdate ? 'nullable|' : 'required|') . self::IMAGE_RULES,
            'introduction'           => 'nullable|string',
            'motto_heading'          => 'nullable|string|max:255',
            'motto_description'      => 'nullable|string',
            'visions'                => 'nullable|array',
            'visions.*.heading'      => 'nullable|string|max:255',
            'visions.*.description'  => 'nullable|string',
        ], [
            'heading.required' => 'Please enter the intro heading.',
            'image.required'   => 'Please upload an image.',
            'image.image'      => 'The file must be a valid image.',
            'image.mimes'      => 'The image must be JPG, PNG or WebP.',
            'image.max'        => 'The image must not be larger than 2 MB.',
        ]);
    }

    /** Replace the intro's vision/mission rows (blank rows are skipped). */
    private function syncVisions(AboutIntro $intro, Request $request): void
    {
        $intro->visions()->delete();

        $order = 0;
        foreach ((array) $request->input('visions', []) as $row) {
            $heading     = trim((string) ($row['heading'] ?? ''));
            $description = trim((string) ($row['description'] ?? ''));

            // Skip fully-empty rows.
            if ($heading === '' && $description === '') {
                continue;
            }

            $intro->visions()->create([
                'heading'     => $heading,
                'description' => $description !== '' ? $description : null,
                'sort_order'  => $order++,
            ]);
        }
    }

    /** Move the uploaded image into /public/about/intro and return its filename. */
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
}
