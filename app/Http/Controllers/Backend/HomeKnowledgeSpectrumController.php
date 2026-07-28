<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeKnowledgeSpectrum;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeKnowledgeSpectrumController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    private const IMAGE_MESSAGES = [
        'background_image.image' => 'The background image must be a valid image.',
        'background_image.mimes' => 'The background image must be JPG, PNG or WebP.',
        'background_image.max'   => 'The background image must not be larger than 2 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'home/knowledge';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:knowledge-spectrum.view', only: ['index']),
            new Middleware('permission:knowledge-spectrum.create', only: ['create', 'store']),
            new Middleware('permission:knowledge-spectrum.edit', only: ['edit', 'update']),
            new Middleware('permission:knowledge-spectrum.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $items = HomeKnowledgeSpectrum::orderByDesc('id')->get();

        return view('backend.home.knowledge.index', compact('items'));
    }

    public function create()
    {
        // Only one knowledge spectrum section is allowed — send them to edit the existing one.
        if ($item = HomeKnowledgeSpectrum::first()) {
            return redirect()->route('manage-home-knowledge-spectrum.edit', $item->id)
                ->with('message', 'Only one knowledge spectrum section is allowed. You can edit the existing one.');
        }

        return view('backend.home.knowledge.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second section.
        if (HomeKnowledgeSpectrum::exists()) {
            return redirect()->route('manage-home-knowledge-spectrum.index')
                ->with('message', 'A knowledge spectrum section already exists. Only one is allowed.');
        }

        $request->validate($this->rules(imageRequired: true), self::IMAGE_MESSAGES + [
            'title.required'            => 'Please enter the title.',
            'background_image.required' => 'Please upload the background image.',
        ]);

        HomeKnowledgeSpectrum::create([
            'title'            => $request->title,
            'heading'          => $request->heading,
            'background_image' => $this->storeImage($request),
            'is_active'        => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-knowledge-spectrum.index')->with('message', 'Knowledge spectrum added successfully.');
    }

    public function edit($id)
    {
        $item = HomeKnowledgeSpectrum::findOrFail($id);

        return view('backend.home.knowledge.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = HomeKnowledgeSpectrum::findOrFail($id);

        $request->validate($this->rules(imageRequired: false), self::IMAGE_MESSAGES + [
            'title.required' => 'Please enter the title.',
        ]);

        // A background image is mandatory — there must be an existing one or a newly uploaded one.
        if (! $item->background_image && ! $request->hasFile('background_image')) {
            return back()->withErrors(['background_image' => 'Please upload the background image.'])->withInput();
        }

        // Replace the background image only when a new one is uploaded.
        $image = $item->background_image;
        if ($request->hasFile('background_image')) {
            $this->deleteImage($item->background_image);
            $image = $this->storeImage($request);
        }

        $item->update([
            'title'            => $request->title,
            'heading'          => $request->heading,
            'background_image' => $image,
            'is_active'        => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-knowledge-spectrum.index')->with('message', 'Knowledge spectrum updated successfully.');
    }

    public function destroy($id)
    {
        $item = HomeKnowledgeSpectrum::findOrFail($id);
        $this->deleteImage($item->background_image);
        $item->delete();

        return redirect()->route('manage-home-knowledge-spectrum.index')->with('message', 'Knowledge spectrum deleted successfully.');
    }

    private function rules(bool $imageRequired): array
    {
        return [
            'title'            => 'required|string|max:255',
            'heading'          => 'nullable|string',
            'background_image' => ($imageRequired ? 'required|' : 'nullable|') . self::IMAGE_RULES,
        ];
    }

    /** Move the uploaded background image into /public/home/knowledge and return its filename. */
    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('background_image')) {
            return null;
        }

        $file   = $request->file('background_image');
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
