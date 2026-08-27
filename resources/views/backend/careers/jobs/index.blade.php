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
                                        <li class="breadcrumb-item active">Job Listing</li>
                                    </ol>
                                </nav>
                                @if(auth()->user()->hasPermission('job-listings.create'))
                                    <a href="{{ route('manage-job-listing.create') }}" class="btn btn-primary px-5 radius-30">+ Add Job Listing</a>
                                @endif
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Role Name</th>
                                            <th>Location</th>
                                            <th>Job Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end" style="min-width:170px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $job->role_name }}</td>
                                                <td>{{ $job->location }}</td>
                                                <td><span class="badge bg-primary">{{ $job->job_type }}</span></td>
                                                <td class="text-center">
                                                    @if($job->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        @if(auth()->user()->hasPermission('job-listings.edit'))
                                                            <a href="{{ route('manage-job-listing.edit', $job->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('job-listings.delete'))
                                                            <form action="{{ route('manage-job-listing.destroy', $job->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this record?')">
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
