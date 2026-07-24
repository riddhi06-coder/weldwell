<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeBannerController extends Controller implements HasMiddleware
{
    /** Allowed video formats + size (8 MB). */
    private const VIDEO_RULES = 'required|file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:8192';

    private const VIDEO_MESSAGES = [
        'video.required'  => 'Please upload a banner video.',
        'video.file'      => 'The uploaded video is invalid.',
        'video.mimetypes' => 'Only MP4, WebM, OGG or MOV video formats are allowed.',
        'video.max'       => 'The video must not be larger than 8 MB.',
    ];

    /** Files are stored here (served directly from /public, no storage:link needed). */
    private const UPLOAD_DIR = 'home/banner';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:home-banners.view', only: ['index']),
            new Middleware('permission:home-banners.create', only: ['create', 'store']),
            new Middleware('permission:home-banners.edit', only: ['edit', 'update']),
            new Middleware('permission:home-banners.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $banners = HomeBanner::orderByDesc('id')->get();

        return view('backend.home.banner.index', compact('banners'));
    }

    public function create()
    {
        // Only one banner is allowed — send them to edit the existing one.
        if ($banner = HomeBanner::first()) {
            return redirect()->route('manage-home-banner.edit', $banner->id)
                ->with('message', 'Only one banner is allowed. You can edit the existing one.');
        }

        return view('backend.home.banner.create');
    }

    public function store(Request $request)
    {
        // Guard: never create a second banner.
        if (HomeBanner::exists()) {
            return redirect()->route('manage-home-banner.index')
                ->with('message', 'A banner already exists. Only one banner is allowed.');
        }

        $request->validate([
            'heading' => 'required|string',
            'title'   => 'required|string',
            'video'   => self::VIDEO_RULES,
        ], self::VIDEO_MESSAGES + [
            'heading.required' => 'Please enter the heading.',
            'title.required'   => 'Please enter the title.',
        ]);

        HomeBanner::create([
            'heading'   => $request->heading,
            'title'     => $request->title,
            'video'     => $this->storeVideo($request),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-banner.index')->with('message', 'Banner added successfully.');
    }

    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);

        return view('backend.home.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = HomeBanner::findOrFail($id);

        $request->validate([
            'heading' => 'required|string',
            'title'   => 'required|string',
            'video'   => str_replace('required|', 'nullable|', self::VIDEO_RULES), // optional on edit
        ], self::VIDEO_MESSAGES + [
            'heading.required' => 'Please enter the heading.',
            'title.required'   => 'Please enter the title.',
        ]);

        $video = $banner->video;
        if ($request->hasFile('video')) {
            $this->deleteVideo($banner->video);
            $video = $this->storeVideo($request);
        }

        $banner->update([
            'heading'   => $request->heading,
            'title'     => $request->title,
            'video'     => $video,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('manage-home-banner.index')->with('message', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = HomeBanner::findOrFail($id);
        $this->deleteVideo($banner->video);
        $banner->delete();

        return redirect()->route('manage-home-banner.index')->with('message', 'Banner deleted successfully.');
    }

    /** Move the uploaded video into /public/home/banner and return its filename. */
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
