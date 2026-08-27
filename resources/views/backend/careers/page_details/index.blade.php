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
                                        <li class="breadcrumb-item active">Career Page Details</li>
                                    </ol>
                                </nav>
                                @if(auth()->user()->hasPermission('career-page-details.create') && $details->isEmpty())
                                    <a href="{{ route('manage-career-page-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Career Page Details</a>
                                @endif
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Banner Heading</th>
                                            <th>Career Heading</th>
                                            <th class="text-center">Benefits</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end" style="min-width:170px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details as $detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->banner_heading }}</td>
                                                <td>{{ $detail->career_heading }}</td>
                                                <td class="text-center"><span class="badge bg-primary">{{ $detail->benefits_count }}</span></td>
                                                <td class="text-center">
                                                    @if($detail->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        @if(auth()->user()->hasPermission('career-page-details.edit'))
                                                            <a href="{{ route('manage-career-page-details.edit', $detail->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('career-page-details.delete'))
                                                            <form action="{{ route('manage-career-page-details.destroy', $detail->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this record?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
