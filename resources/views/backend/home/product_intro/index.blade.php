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
                <div class="col-6"><h3>Products Introduction</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('product-intros.create') && $intros->isEmpty())
                        <a href="{{ route('manage-product-intro.create') }}" class="btn btn-primary">+ Add Product Intro</a>
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
                                        <th>Title</th>
                                        <th class="text-center">Qualities</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($intros as $intro)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $intro->heading }}</td>
                                            <td>{{ $intro->title }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-info">{{ $intro->qualities_count }}</span>
                                            </td>
                                            <td>
                                                @if($intro->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('product-intros.edit'))
                                                        <a href="{{ route('manage-product-intro.edit', $intro->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('product-intros.delete'))
                                                        <form action="{{ route('manage-product-intro.destroy', $intro->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this product introduction?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-4">No product introduction found.</td></tr>
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
