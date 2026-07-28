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
                <div class="col-6"><h3>Knowledge Spectrum</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('knowledge-spectrum.create') && $items->isEmpty())
                        <a href="{{ route('manage-home-knowledge-spectrum.create') }}" class="btn btn-primary">+ Add Knowledge Spectrum</a>
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
                                        <th class="text-center">Background Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                @if($item->background_image)
                                                    <img src="{{ asset('home/knowledge/'.$item->background_image) }}" alt=""
                                                        style="height:70px;width:110px;object-fit:cover;border-radius:8px;">
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('knowledge-spectrum.edit'))
                                                        <a href="{{ route('manage-home-knowledge-spectrum.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('knowledge-spectrum.delete'))
                                                        <form action="{{ route('manage-home-knowledge-spectrum.destroy', $item->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this knowledge spectrum?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-4">No knowledge spectrum found.</td></tr>
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
