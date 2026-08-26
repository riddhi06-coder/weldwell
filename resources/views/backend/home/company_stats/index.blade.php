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
                <div class="col-6"></div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon"><use href="../assets/svg/icon-sprite.svg#stroke-home"></use></svg>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Company Stats</li>
                                </ol>
                            </nav>
                            @if(auth()->user()->hasPermission('company-stats.create') && $stats->isEmpty())
                        <a href="{{ route('manage-company-stats.create') }}" class="btn btn-primary px-5 radius-30">+ Add Company Stats</a>
                    @endif
                        </div>

                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Video</th>
                                        <th class="text-center">Stats</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stats as $stat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($stat->video)
                                                    <video src="{{ asset('home/company-stats/'.$stat->video) }}" width="220" muted controls class="rounded border"></video>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">{{ $stat->items_count }}</span>
                                            </td>
                                            <td>
                                                @if($stat->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('company-stats.edit'))
                                                        <a href="{{ route('manage-company-stats.edit', $stat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('company-stats.delete'))
                                                        <form action="{{ route('manage-company-stats.destroy', $stat->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this company stats section?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-4">No company stats found.</td></tr>
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
