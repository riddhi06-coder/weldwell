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
                <div class="col-6"><h3>About Details</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('home-about.create') && $abouts->isEmpty())
                        <a href="{{ route('manage-home-about.create') }}" class="btn btn-primary">+ Add About Details</a>
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
                                        <th class="text-center">Images</th>
                                        <th>Experience</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($abouts as $about)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $about->heading }}</td>
                                            <td class="text-center">
                                                <div class="d-flex gap-1 justify-content-center">
                                                    @foreach(['image1','image2','image3'] as $img)
                                                        @if($about->{$img})
                                                            <img src="{{ asset('home/about/'.$about->{$img}) }}" alt=""
                                                                style="height:36px;width:36px;object-fit:cover;border-radius:6px;">
                                                        @endif
                                                    @endforeach
                                                    @if(!$about->image1 && !$about->image2 && !$about->image3)
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $about->experience ? trim($about->experience.' '.$about->experience_title) : '—' }}</td>
                                            <td>
                                                @if($about->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('home-about.edit'))
                                                        <a href="{{ route('manage-home-about.edit', $about->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('home-about.delete'))
                                                        <form action="{{ route('manage-home-about.destroy', $about->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this about section?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-4">No about details found.</td></tr>
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
