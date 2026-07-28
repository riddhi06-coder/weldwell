<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyStat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeCompanyStatsController extends Controller implements HasMiddleware
{
    /** Allowed video formats + size (8 MB). */
    private const VIDEO_RULES = 'file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:8192';

    private const VIDEO_MESSAGES = [
        'video.file'      => 'The uploaded video is invalid.',
        'video.mimetypes' => 'Only MP4, WebM, OGG or MOV video formats are allowed.',
        'video.max'       => 'The video must not be larger than 8 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'home/company-stats';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:company-stats.view', only: ['index']),
            new Middleware('permission:company-stats.create', only: ['create', 'store']),
            new Middleware('permission:company-stats.edit', only: ['edit', 'update']),
            new Middleware('permission:company-stats.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $stats = CompanyStat::withCount('items')->orderByDesc('id')->get();

        return view('backend.home.company_stats.index', compact('stats'));
    }

    public function create()
    {
        // Only one company-stats section is allowed — send them to edit the existing one.
        if ($stat = CompanyStat::first()) {
            return redirect()->route('manage-company-stats.edit', $stat->id)
                ->with('message', 'Only one company stats section is allowed. You can edit the existing one.');
        }

        return view('backend.home.company_stats.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second company-stats section.
        if (CompanyStat::exists()) {
            return redirect()->route('manage-company-stats.index')
                ->with('message', 'A company stats section already exists. Only one is allowed.');
        }

        $request->validate([
            'video'       => 'required|' . self::VIDEO_RULES,
            'stat_no'     => 'nullable|array',
            'stat_no.*'   => 'nullable|string|max:255',
            'stat_name'   => 'nullable|array',
            'stat_name.*' => 'nullable|string|max:255',
        ], self::VIDEO_MESSAGES + ['video.required' => 'Please upload a video.']);

        $stat = CompanyStat::create([
            'video'     => $this->storeVideo($request),
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncItems($stat, $request);

        return redirect()->route('manage-company-stats.index')->with('message', 'Company stats added successfully.');
    }

    public function edit($id)
    {
        $stat = CompanyStat::with('items')->findOrFail($id);

        return view('backend.home.company_stats.edit', compact('stat'));
    }

    public function update(Request $request, $id)
    {
        $stat = CompanyStat::findOrFail($id);

        $request->validate([
            'video'       => 'nullable|' . self::VIDEO_RULES, // optional on edit
            'stat_no'     => 'nullable|array',
            'stat_no.*'   => 'nullable|string|max:255',
            'stat_name'   => 'nullable|array',
            'stat_name.*' => 'nullable|string|max:255',
        ], self::VIDEO_MESSAGES);

        $video = $stat->video;
        if ($request->hasFile('video')) {
            $this->deleteVideo($stat->video);
            $video = $this->storeVideo($request);
        }

        $stat->update([
            'video'     => $video,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncItems($stat, $request);

        return redirect()->route('manage-company-stats.index')->with('message', 'Company stats updated successfully.');
    }

    public function destroy($id)
    {
        $stat = CompanyStat::findOrFail($id);
        $this->deleteVideo($stat->video);
        // CompanyStat is soft-deleted, so the DB FK cascade won't fire — remove items explicitly.
        $stat->items()->delete();
        $stat->delete();

        return redirect()->route('manage-company-stats.index')->with('message', 'Company stats deleted successfully.');
    }

    /** Replace the section's stat rows with the submitted ones (rows with both fields blank are skipped). */
    private function syncItems(CompanyStat $stat, Request $request): void
    {
        $stat->items()->delete();

        $numbers = (array) $request->input('stat_no', []);
        $names   = (array) $request->input('stat_name', []);
        $count   = max(count($numbers), count($names));

        $order = 0;
        for ($i = 0; $i < $count; $i++) {
            $no   = trim((string) ($numbers[$i] ?? ''));
            $name = trim((string) ($names[$i] ?? ''));

            if ($no === '' && $name === '') {
                continue;
            }

            $stat->items()->create([
                'stat_no'    => $no,
                'stat_name'  => $name,
                'sort_order' => $order++,
            ]);
        }
    }

    /** Move the uploaded video into /public/home/company-stats and return its filename. */
    private function storeVideo(Request $request): ?string
    {
        if (! $request->hasFile('video')) {
            return null;
        }

        $file   = $request->file('video');
        $folder = public_path(self::UPLOAD_DIR);

        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return $fileName;
    }

    private function deleteVideo(?string $fileName): void
    {
        if ($fileName && file_exists(public_path(self::UPLOAD_DIR . '/' . $fileName))) {
            @unlink(public_path(self::UPLOAD_DIR . '/' . $fileName));
        }
    }
}
