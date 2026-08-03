<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class EventsController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'events';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:events.view', only: ['index']),
            new Middleware('permission:events.create', only: ['create', 'store']),
            new Middleware('permission:events.edit', only: ['edit', 'update']),
            new Middleware('permission:events.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $events = Event::orderByDesc('id')->get();

        return view('backend.events.index', compact('events'));
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        Event::create([
            'title'     => $request->title,
            'slug'      => $this->uniqueSlug($request->title),
            'thumbnail' => $this->storeImage($request),
            'date'      => $request->date,
            'tags'      => $this->parseTags($request->tags),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-events.index')->with('message', 'Event added successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate($this->rules(), $this->messages());

        // Regenerate the slug only when the title changes (keeps existing slugs stable).
        $slug = $event->slug;
        if ($request->title !== $event->title || empty($slug)) {
            $slug = $this->uniqueSlug($request->title, $event->id);
        }

        // Replace the thumbnail only when a new one is uploaded.
        $thumbnail = $event->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($event->thumbnail);
            $thumbnail = $this->storeImage($request);
        }

        $event->update([
            'title'     => $request->title,
            'slug'      => $slug,
            'thumbnail' => $thumbnail,
            'date'      => $request->date,
            'tags'      => $this->parseTags($request->tags),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-events.index')->with('message', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $this->deleteImage($event->thumbnail);
        $event->delete();

        return redirect()->route('manage-events.index')->with('message', 'Event deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    private function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'thumbnail' => 'nullable|' . self::IMAGE_RULES,
            'date'      => 'nullable|date',
            'tags'      => 'nullable|string|max:1000',
        ];
    }

    private function messages(): array
    {
        return [
            'title.required'  => 'Please enter the event title.',
            'thumbnail.image' => 'The thumbnail must be a valid image.',
            'thumbnail.mimes' => 'The thumbnail must be JPG, PNG or WebP.',
            'thumbnail.max'   => 'The thumbnail must not be larger than 2 MB.',
            'date.date'       => 'Please enter a valid date.',
        ];
    }

    /** Split a comma-separated tag string into a clean array (or null when empty). */
    private function parseTags(?string $tags): ?array
    {
        if (! $tags) {
            return null;
        }

        $list = collect(explode(',', $tags))
            ->map(fn ($t) => trim($t))
            ->filter()
            ->values()
            ->all();

        return $list ?: null;
    }

    /** Build a URL-safe, unique slug from the given title. */
    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        if ($base === '') {
            $base = 'event-' . uniqid();
        }

        $slug = $base;
        $i    = 1;
        while (
            Event::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /** Move the uploaded thumbnail into /public/events and return its filename. */
    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('thumbnail')) {
            return null;
        }

        $file   = $request->file('thumbnail');
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
