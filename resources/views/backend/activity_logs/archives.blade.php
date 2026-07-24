<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
</head>
<body>
@include('components.backend.header')
@include('components.backend.sidebar')

@php
    $fmtSize = function ($bytes) {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    };
@endphp

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6"><h3>Archived Logs</h3></div>
                <div class="col-6 text-end">
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-light">Back to Activity Log</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>How storage is managed —</strong> logs stay in the live table for
                            <strong>{{ $retention }} days</strong> ({{ round($retention / 30) }} months), then are automatically moved into the
                            compressed monthly archive files below. <strong>Nothing is ever deleted</strong> — archives can be
                            downloaded any time, or restored back into the live table. The live table currently holds
                            <strong>{{ number_format($liveCount) }}</strong> log(s).
                        </div>

                        <form action="{{ route('admin.activity-logs.archive.run') }}" method="POST" class="mb-3"
                              onsubmit="return confirm('Archive all logs older than {{ $retention }} days now?')">
                            @csrf
                            <button type="submit" class="btn btn-primary">Run Archive Now</button>
                            <small class="text-muted ms-2">Also runs automatically on the 1st of each month.</small>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Archive File</th>
                                        <th>Period</th>
                                        <th>Size</th>
                                        <th>Last Updated</th>
                                        <th class="text-end" style="min-width:220px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($archives as $a)
                                        @php
                                            preg_match('/([0-9]{4})-([0-9]{2})/', $a['name'], $m);
                                            $period = isset($m[1]) ? \Carbon\Carbon::createFromDate($m[1], $m[2], 1)->format('F Y') : '—';
                                        @endphp
                                        <tr>
                                            <td><code>{{ $a['name'] }}</code></td>
                                            <td>{{ $period }}</td>
                                            <td>{{ $fmtSize($a['size']) }}</td>
                                            <td>{{ \Carbon\Carbon::createFromTimestamp($a['last_modified'])->format('d M Y, h:i A') }}</td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    <a href="{{ route('admin.activity-logs.archive.download', $a['name']) }}" class="btn btn-sm btn-primary">Download</a>
                                                    <form action="{{ route('admin.activity-logs.archive.restore') }}" method="POST" class="m-0"
                                                          onsubmit="return confirm('Restore {{ $a['name'] }} back into the live table?')">
                                                        @csrf
                                                        <input type="hidden" name="file" value="{{ $a['name'] }}">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Restore</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-4">No archives yet. Logs older than {{ $retention }} days will appear here once archived.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.backend.footer')
</div>

@include('components.backend.main-js')
</body>
</html>
