<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeClient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeClientsController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'home/clients';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:home-clients.view', only: ['index']),
            new Middleware('permission:home-clients.create', only: ['create', 'store']),
            new Middleware('permission:home-clients.edit', only: ['edit', 'update']),
            new Middleware('permission:home-clients.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $clients = HomeClient::withCount('photos')->orderByDesc('id')->get();

        return view('backend.home.clients.index', compact('clients'));
    }

    public function create()
    {
        // Only one clients section is allowed — send them to edit the existing one.
        if ($client = HomeClient::first()) {
            return redirect()->route('manage-home-clients.edit', $client->id)
                ->with('message', 'Only one clients section is allowed. You can edit the existing one.');
        }

        return view('backend.home.clients.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second clients section.
        if (HomeClient::exists()) {
            return redirect()->route('manage-home-clients.index')
                ->with('message', 'A clients section already exists. Only one is allowed.');
        }

        $request->validate($this->rules(imageRequired: true), $this->messages());

        // At least one client photo is required.
        $files = $this->uploadedPhotos($request);
        if (count($files) === 0) {
            return back()->withErrors(['new_photos' => 'Please add at least one client photo.'])->withInput();
        }

        $client = HomeClient::create([
            'image'     => $this->storeFile($request->file('image')),
            'is_active' => $request->boolean('is_active'),
        ]);

        // Add the uploaded client photos.
        $order = 0;
        foreach ($files as $file) {
            $client->photos()->create([
                'photo'      => $this->storeFile($file),
                'sort_order' => $order++,
            ]);
        }

        return redirect()->route('manage-home-clients.index')->with('message', 'Clients section added successfully.');
    }

    public function edit($id)
    {
        $client = HomeClient::with('photos')->findOrFail($id);

        return view('backend.home.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = HomeClient::findOrFail($id);

        $request->validate($this->rules(imageRequired: false), $this->messages());

        // A section image is mandatory — there must be an existing one or a newly uploaded one.
        if (! $client->image && ! $request->hasFile('image')) {
            return back()->withErrors(['image' => 'Please upload the section image.'])->withInput();
        }

        // At least one client photo must remain (kept + newly uploaded).
        $keepCount = count(array_filter((array) $request->input('keep_photos', [])));
        $newCount  = count($this->uploadedPhotos($request));
        if ($keepCount + $newCount === 0) {
            return back()->withErrors(['new_photos' => 'Please keep or add at least one client photo.'])->withInput();
        }

        // Section image: replace only when a new one is uploaded.
        $image = $client->image;
        if ($request->hasFile('image')) {
            $this->deleteFile($client->image);
            $image = $this->storeFile($request->file('image'));
        }

        $client->update([
            'image'     => $image,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Remove existing photos the user deleted from the table (kept ones come back as keep_photos[]).
        $keep = (array) $request->input('keep_photos', []);
        foreach ($client->photos()->get() as $photo) {
            if (! in_array($photo->photo, $keep, true)) {
                $this->deleteFile($photo->photo);
                $photo->delete();
            }
        }

        // Re-number the kept photos to match their order in the form.
        $order = 0;
        foreach ($keep as $filename) {
            $client->photos()->where('photo', $filename)->update(['sort_order' => $order++]);
        }

        // Append any newly uploaded photos.
        foreach ($this->uploadedPhotos($request) as $file) {
            $client->photos()->create([
                'photo'      => $this->storeFile($file),
                'sort_order' => $order++,
            ]);
        }

        return redirect()->route('manage-home-clients.index')->with('message', 'Clients section updated successfully.');
    }

    public function destroy($id)
    {
        $client = HomeClient::with('photos')->findOrFail($id);

        $this->deleteFile($client->image);
        foreach ($client->photos as $photo) {
            $this->deleteFile($photo->photo);
        }
        // HomeClient is soft-deleted, so the DB FK cascade won't fire — remove photos explicitly.
        $client->photos()->delete();
        $client->delete();

        return redirect()->route('manage-home-clients.index')->with('message', 'Clients section deleted successfully.');
    }

    private function rules(bool $imageRequired): array
    {
        return [
            'image'         => ($imageRequired ? 'required|' : 'nullable|') . self::IMAGE_RULES,
            'keep_photos'   => 'nullable|array',
            'keep_photos.*' => 'nullable|string',
            'new_photos'    => 'nullable|array',
            'new_photos.*'  => 'nullable|' . self::IMAGE_RULES,
        ];
    }

    private function messages(): array
    {
        return [
            'image.required'     => 'Please upload the section image.',
            'image.image'        => 'The section image must be a valid image.',
            'image.mimes'        => 'The section image must be JPG, PNG or WebP.',
            'image.max'          => 'The section image must not be larger than 2 MB.',
            'new_photos.*.image' => 'Each client photo must be a valid image.',
            'new_photos.*.mimes' => 'Client photos must be JPG, PNG or WebP.',
            'new_photos.*.max'   => 'Each client photo must not be larger than 2 MB.',
        ];
    }

    /** Only the file inputs that actually received an upload. */
    private function uploadedPhotos(Request $request): array
    {
        return array_filter((array) $request->file('new_photos', []));
    }

    /** Move an uploaded file into /public/home/clients and return its filename. */
    private function storeFile($file): ?string
    {
        if (! $file) {
            return null;
        }

        $folder = public_path(self::UPLOAD_DIR);
        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return $fileName;
    }

    private function deleteFile(?string $fileName): void
    {
        if ($fileName && file_exists(public_path(self::UPLOAD_DIR . '/' . $fileName))) {
            @unlink(public_path(self::UPLOAD_DIR . '/' . $fileName));
        }
    }
}
