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
                                    <li class="breadcrumb-item active">Testimonials</li>
                                </ol>
                            </nav>
                            @if(auth()->user()->hasPermission('testimonials.create'))
                        <a href="{{ route('manage-testimonials.create') }}" class="btn btn-primary px-5 radius-30">+ Add Testimonial</a>
                    @endif
                        </div>

                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Client Name</th>
                                        <th>Industry Type</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $testimonial->client_name }}</td>
                                            <td>{{ $testimonial->industry_type }}</td>
                                            <td>
                                                @if($testimonial->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('testimonials.edit'))
                                                        <a href="{{ route('manage-testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('testimonials.delete'))
                                                        <form action="{{ route('manage-testimonials.destroy', $testimonial->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this testimonial?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-4">No testimonials found.</td></tr>
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
