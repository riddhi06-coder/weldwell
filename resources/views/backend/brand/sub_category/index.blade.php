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
                                    <li class="breadcrumb-item active">Brand List</li>
                                </ol>
                            </nav>
                            @if(auth()->user()->hasPermission('brand-subcategories.create'))
                                <a href="{{ route('manage-brand-list.create') }}" class="btn btn-primary px-5 radius-30">+ Add Brand List</a>
                            @endif
                        </div>

                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="brandListTable">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Logo</th>
                                        <th style="width:50%;">Brand Name</th>
                                        <th>Brand Category</th>
                                        <th class="text-end" style="width:30%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subCategories as $sub)
                                        <tr>
                                            <td>
                                                @if($sub->image)
                                                    <img src="{{ asset('brand/subcategory/' . $sub->image) }}" alt="{{ $sub->name }}">
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $sub->name }}</td>
                                            <td>{{ $sub->mainCategory?->name ?? 'Uncategorized' }}</td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('brand-subcategories.edit'))
                                                        <a href="{{ route('manage-brand-list.edit', $sub->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('brand-subcategories.delete'))
                                                        <form action="{{ route('manage-brand-list.destroy', $sub->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this brand?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center text-muted py-4">No brand list entries found.</td></tr>
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

{{-- DataTables RowGroup — grouped by Brand Category. --}}
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.dataTables.min.css">
<script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
<style>
    #brandListTable tr.dtrg-group td {
        background: #999090;
        color: #fff;
        font-weight: 600;
    }
    /* every logo rendered in an identical white tile so mixed-background images line up */
    #brandListTable tbody td:first-child img {
        height: 48px;
        width: 108px;
        object-fit: contain;
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 6px;
        padding: 5px 8px;
        display: block;
    }
    #brandListTable tbody td { vertical-align: middle; }
    /* fill the full card width with proportional (%) columns */
    #brandListTable { width: 100% !important; table-layout: fixed; }
</style>
<script>
    (function () {
        function initGrouped() {
            if (!window.jQuery || !$.fn.dataTable || !$.fn.dataTable.RowGroup) {
                return setTimeout(initGrouped, 100);
            }
            if (!document.getElementById('brandListTable') || $.fn.dataTable.isDataTable('#brandListTable')) return;

            $('#brandListTable').DataTable({
                autoWidth: false,
                order: [[2, 'asc'], [1, 'asc']],
                columnDefs: [{ targets: 2, visible: false }],
                rowGroup: { dataSrc: 2 }
            });
        }
        initGrouped();
    })();
</script>

</body>
</html>
