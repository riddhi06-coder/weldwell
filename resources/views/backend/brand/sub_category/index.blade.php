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
                <div class="col-6"><h3>Brand Sub Categories</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('brand-subcategories.create'))
                        <a href="{{ route('manage-brand-subcategory.create') }}" class="btn btn-primary">+ Add Sub Category</a>
                    @endif
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Sub Category Name</th>
                                        <th>Parent Category</th>
                                        <th>Slug</th>
                                        <th>Created</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subCategories as $sub)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sub->name }}</td>
                                            <td>
                                                @if($sub->mainCategory)
                                                    <span class="badge bg-primary">{{ $sub->mainCategory->name }}</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td><code>{{ $sub->slug }}</code></td>
                                            <td>{{ optional($sub->created_at)->format('d M Y') }}</td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('brand-subcategories.edit'))
                                                        <a href="{{ route('manage-brand-subcategory.edit', $sub->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('brand-subcategories.delete'))
                                                        <form action="{{ route('manage-brand-subcategory.destroy', $sub->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this sub category?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-4">No sub categories found.</td></tr>
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
