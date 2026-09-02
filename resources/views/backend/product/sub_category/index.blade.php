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
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active">Product Sub Category</li>
                                    </ol>
                                </nav>
                                <a href="{{ route('manage-product-subcategory.create') }}" class="btn btn-primary px-5 radius-30">
                                    + Add Product Sub Category
                                </a>
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="productSubCategoryTable">
                                    <thead>
                                        <tr>
                                            <th>Sub Category Name</th>
                                            <th>Product Category</th>
                                            <th class="text-center" style="width:110px;">Status</th>
                                            <th class="text-end" style="min-width:170px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($subCategories as $sub)
                                            <tr>
                                                <td>{{ $sub->name }}</td>
                                                <td>{{ $sub->productCategory?->name ?? 'Uncategorized' }}</td>
                                                <td class="text-center">
                                                    @if($sub->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        <a href="{{ route('manage-product-subcategory.edit', $sub->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <form action="{{ route('manage-product-subcategory.destroy', $sub->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this sub category?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center text-muted py-4">No product sub categories found.</td></tr>
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
    @include('components.backend.main-js')

    {{-- DataTables RowGroup — grouped by Product Category. --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.dataTables.min.css">
    <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
    <style>
        #productSubCategoryTable tr.dtrg-group td {
            background: #999090;
            color: #fff;
            font-weight: 600;
        }
        #productSubCategoryTable tbody td { vertical-align: middle; }
        #productSubCategoryTable { width: 100% !important; }
    </style>
    <script>
        (function () {
            function initGrouped() {
                if (!window.jQuery || !$.fn.dataTable || !$.fn.dataTable.RowGroup) {
                    return setTimeout(initGrouped, 100);
                }
                if (!document.getElementById('productSubCategoryTable') || $.fn.dataTable.isDataTable('#productSubCategoryTable')) return;

                $('#productSubCategoryTable').DataTable({
                    autoWidth: false,
                    order: [[1, 'asc'], [0, 'asc']],
                    columnDefs: [{ targets: 1, visible: false }],
                    rowGroup: { dataSrc: 1 }
                });
            }
            initGrouped();
        })();
    </script>

</body>
</html>
