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
                <div class="col-6"><h3>Banners</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('home-banners.create') && $banners->isEmpty())
                        <a href="{{ route('manage-home-banner.create') }}" class="btn btn-primary">+ Add Banner</a>
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
                                        <th>Heading</th>
                                        <!-- <th>Title</th> -->
                                        <th>Video</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $banner->heading !!}</td>
                                            <!-- <td>{!! $banner->title !!}</td> -->
                                            <td>
                                                @if($banner->video)
                                                    <video src="{{ asset('home/banner/'.$banner->video) }}" width="260" muted controls class="rounded border"></video>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($banner->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('home-banners.edit'))
                                                        <a href="{{ route('manage-home-banner.edit', $banner->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('home-banners.delete'))
                                                        <form action="{{ route('manage-home-banner.destroy', $banner->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this banner?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-4">No banners found.</td></tr>
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
