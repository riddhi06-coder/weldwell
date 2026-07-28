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
                <div class="col-6"><h3>Brand Categories</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('brand-categories.create'))
                        <a href="{{ route('manage-brand-catgeory.create') }}" class="btn btn-primary">+ Add Category</a>
                    @endif
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th class="text-center">Image</th>
                                        <th>Category Name</th>
                                        <th>Title</th>
                                        <th class="text-center">Brand Header</th>
                                        <th class="text-center">Product Header</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                @if($category->image)
                                                    <img src="{{ asset('brand/category/' . $category->image) }}" alt="{{ $category->name }}"
                                                        style="height:40px;width:40px;object-fit:cover;border-radius:6px;">
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->title ?: '—' }}</td>
                                            <td class="text-center">
                                                @if($category->show_in_brand_header)
                                                    <span class="badge bg-success">Shown</span>
                                                @else
                                                    <span class="badge bg-secondary">Hidden</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($category->show_in_product_header)
                                                    <span class="badge bg-success">Shown</span>
                                                @else
                                                    <span class="badge bg-secondary">Hidden</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('brand-categories.edit'))
                                                        <a href="{{ route('manage-brand-catgeory.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('brand-categories.delete'))
                                                        <form action="{{ route('manage-brand-catgeory.destroy', $category->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this category?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted py-4">No categories found.</td></tr>
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
