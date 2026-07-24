<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Support\AuditArchiver;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query()->with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('description', 'like', "%{$s}%")
                    ->orWhere('user_name', 'like', "%{$s}%")
                    ->orWhere('auditable_id', 'like', "%{$s}%");
            });
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->orderByDesc('id')->paginate(30)->withQueryString();

        $users   = User::orderBy('name')->get(['id', 'name']);
        $modules = ActivityLog::query()->select('module')->distinct()->orderBy('module')->pluck('module')->filter()->values();
        $events  = ActivityLog::query()->select('event')->distinct()->orderBy('event')->pluck('event')->filter()->values();

        return view('backend.activity_logs.index', compact('logs', 'users', 'modules', 'events'));
    }

    public function show($id)
    {
        $log   = ActivityLog::with('user')->findOrFail($id);
        $users = User::withTrashed()->pluck('name', 'id');

        return view('backend.activity_logs.show', compact('log', 'users'));
    }

    // ---------------------------------------------------------------
    // Archive management (offloaded, compressed logs — never deleted)
    // ---------------------------------------------------------------
    public function archives(AuditArchiver $archiver)
    {
        $archives  = $archiver->listArchives();
        $liveCount = ActivityLog::count();
        $retention = (int) config('audit.archive_after_days', 365);

        return view('backend.activity_logs.archives', compact('archives', 'liveCount', 'retention'));
    }

    public function downloadArchive(string $file, AuditArchiver $archiver)
    {
        abort_unless(preg_match('/^activity-logs-[0-9]{4}-[0-9]{2}\.json\.gz$/', $file), 404);

        $path = $archiver->path($file);
        abort_unless($archiver->disk()->exists($path), 404);

        return $archiver->disk()->download($path);
    }

    public function restoreArchive(Request $request, AuditArchiver $archiver)
    {
        $file = $request->input('file');
        abort_unless(preg_match('/^activity-logs-[0-9]{4}-[0-9]{2}\.json\.gz$/', (string) $file), 404);

        try {
            $restored = $archiver->restore($file);
        } catch (\Throwable $e) {
            return back()->with('message', $e->getMessage());
        }

        return back()->with('message', "Restored {$restored} log(s) from {$file} back into the live table.");
    }

    public function runArchive(AuditArchiver $archiver)
    {
        $result = $archiver->archive();

        return back()->with('message', "Archived {$result['archived']} log(s) into " . count($result['files']) . ' file(s).');
    }
}
