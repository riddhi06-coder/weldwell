<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeAboutController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'image1.image' => 'Image 1 must be a valid image.',
        'image1.mimes' => 'Image 1 must be JPG, PNG or WebP.',
        'image1.max'   => 'Image 1 must not be larger than 2 MB.',
        'image2.image' => 'Image 2 must be a valid image.',
        'image2.mimes' => 'Image 2 must be JPG, PNG or WebP.',
        'image2.max'   => 'Image 2 must not be larger than 2 MB.',
        'image3.image' => 'Image 3 must be a valid image.',
        'image3.mimes' => 'Image 3 must be JPG, PNG or WebP.',
        'image3.max'   => 'Image 3 must not be larger than 2 MB.',
    ];

    /** The three image fields this section carries. */
    private const IMAGE_FIELDS = ['image1', 'image2', 'image3'];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'home/about';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:home-about.view', only: ['index']),
            new Middleware('permission:home-about.create', only: ['create', 'store']),
            new Middleware('permission:home-about.edit', only: ['edit', 'update']),
            new Middleware('permission:home-about.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $abouts = HomeAbout::orderByDesc('id')->get();

        return view('backend.home.about.index', compact('abouts'));
    }

    public function create()
    {
        // Only one About section is allowed — send them to edit the existing one.
        if ($about = HomeAbout::first()) {
            return redirect()->route('manage-home-about.edit', $about->id)
                ->with('message', 'Only one about section is allowed. You can edit the existing one.');
        }

        return view('backend.home.about.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second About section.
        if (HomeAbout::exists()) {
            return redirect()->route('manage-home-about.index')
                ->with('message', 'An about section already exists. Only one is allowed.');
        }

        $request->validate($this->rules(), self::IMAGE_MESSAGES + [
            'heading.required' => 'Please enter the heading.',
        ]);

        $data = $this->payload($request);

        foreach (self::IMAGE_FIELDS as $field) {
            $data[$field] = $this->storeImage($request, $field);
        }

        HomeAbout::create($data);

        return redirect()->route('manage-home-about.index')->with('message', 'About details added successfully.');
    }

    public function edit($id)
    {
        $about = HomeAbout::findOrFail($id);

        return view('backend.home.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = HomeAbout::findOrFail($id);

        $request->validate($this->rules(), self::IMAGE_MESSAGES + [
            'heading.required' => 'Please enter the heading.',
        ]);

        $data = $this->payload($request);

        // Replace each image only when a new one is uploaded; otherwise keep the existing file.
        foreach (self::IMAGE_FIELDS as $field) {
            if ($request->hasFile($field)) {
                $this->deleteImage($about->{$field});
                $data[$field] = $this->storeImage($request, $field);
            } else {
                $data[$field] = $about->{$field};
            }
        }

        $about->update($data);

        return redirect()->route('manage-home-about.index')->with('message', 'About details updated successfully.');
    }

    public function destroy($id)
    {
        $about = HomeAbout::findOrFail($id);

        foreach (self::IMAGE_FIELDS as $field) {
            $this->deleteImage($about->{$field});
        }

        $about->delete();

        return redirect()->route('manage-home-about.index')->with('message', 'About details deleted successfully.');
    }

    /** Validation rules shared by store/update. */
    private function rules(): array
    {
        return [
            'heading'           => 'required|string|max:255',
            'title'             => 'nullable|string',
            'image1'            => 'nullable|' . self::IMAGE_RULES,
            'image2'            => 'nullable|' . self::IMAGE_RULES,
            'image3'            => 'nullable|' . self::IMAGE_RULES,
            'small_intro'       => 'nullable|string',
            'description'       => 'nullable|string',
            'experience_title'  => 'nullable|string|max:255',
            'experience'        => ['nullable', 'string', 'max:50', 'regex:/^[0-9]+\+?$/'],
        ];
    }

    /** Non-file column values shared by store/update. */
    private function payload(Request $request): array
    {
        return [
            'heading'          => $request->heading,
            'title'            => $request->title,
            'small_intro'      => $request->small_intro,
            'description'      => $request->description,
            'experience_title' => $request->experience_title,
            'experience'       => $request->experience,
            'is_active'        => $request->boolean('is_active'),
        ];
    }

    /** Move an uploaded image into /public/home/about and return its filename. */
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
