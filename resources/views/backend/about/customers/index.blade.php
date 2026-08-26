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
                                        <li class="breadcrumb-item active">Customers Served</li>
                                    </ol>
                                </nav>
                                {{-- Show Add only while no ACTIVE record exists (inactive ones don't block it). --}}
                                @if(auth()->user()->hasPermission('about-customer.create') && ! $customers->firstWhere('is_active', true))
                                    <a href="{{ route('manage-about-customer.create') }}" class="btn btn-primary px-5 radius-30">
                                        + Add Customers Served
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Heading</th>
                                            <th>Title</th>
                                            <th>Features</th>
                                            <th>Highlights</th>
                                            <th>Status</th>
                                            <th class="text-end" style="min-width:170px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customers as $customer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $customer->heading ?: '—' }}</td>
                                                <td>{{ $customer->title ?: '—' }}</td>
                                                <td><span class="badge bg-primary">{{ $customer->features_count }}</span></td>
                                                <td><span class="badge bg-primary">{{ $customer->highlights_count }}</span></td>
                                                <td>
                                                    @if($customer->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        @if(auth()->user()->hasPermission('about-customer.edit'))
                                                            <a href="{{ route('manage-about-customer.edit', $customer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('about-customer.delete'))
                                                            <form action="{{ route('manage-about-customer.destroy', $customer->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this customer section?');">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="7" class="text-center text-muted py-4">No customer section added yet.</td></tr>
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
</body>
</html>
