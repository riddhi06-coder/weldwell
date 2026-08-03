<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
</head>
<body>
@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6"><h3>Events</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('events.create'))
                        <a href="{{ route('manage-events.create') }}" class="btn btn-primary">+ Add Event</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th class="text-center">Thumbnail</th>
                                        <th>Title</th>                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                @if($event->thumbnail)
                                                    <img src="{{ asset('events/'.$event->thumbnail) }}" alt=""
                                                        style="height:44px;width:64px;object-fit:cover;border-radius:6px;">
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $event->title }}</td>
                                            <td>
                                                @forelse($event->tags ?? [] as $tag)
                                                    <span class="badge bg-light text-dark border me-1 mb-1">{{ $tag }}</span>
                                                @empty
                                                    <span class="text-muted">—</span>
                                                @endforelse
                                            </td>
                                            <td>
                                                @if($event->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('events.edit'))
                                                        <a href="{{ route('manage-events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('events.delete'))
                                                        <form action="{{ route('manage-events.destroy', $event->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this event?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted py-4">No events found.</td></tr>
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
