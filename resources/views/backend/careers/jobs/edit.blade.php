<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
</head>

<body>
    @include('components.backend.header')
    @include('components.backend.sidebar')

    <style>
        /* Highlighted section header bar inside each bordered section box. */
        .custom-input .section-title {
            padding: 12px 16px;
            margin: -16px -16px 22px -16px;
            border-bottom: 1px solid rgba(128, 128, 128, .2);
            border-left: 4px solid #e5011c;
            border-radius: 8px 8px 0 0;
            background: rgba(128, 128, 128, .18);
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .2px;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6"><h4>Edit Job Listing</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-job-listing.index') }}">Job Listing</a></li>
                            <li class="breadcrumb-item active">Edit Job Listing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Job Listing Form</h4>
                            <p class="f-m-light mt-1">Update this open position.</p>
                        </div>
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Please fix the following:</strong>
                                    <ul class="mb-0 mt-1">
                                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="row g-4 custom-input" action="{{ route('manage-job-listing.update', $job->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Job Details</h5>
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <label class="form-label" for="role_name">Role Name <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="role_name" type="text" name="role_name"
                                                    value="{{ old('role_name', $job->role_name) }}" placeholder="e.g. Sales Engineer">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="location">Location <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="location" type="text" name="location"
                                                    value="{{ old('location', $job->location) }}" placeholder="e.g. Mumbai, India">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="job_type">Job Type <span class="txt-danger">*</span></label>
                                                <select class="form-select" id="job_type" name="job_type">
                                                    <option value="">Select Job Type</option>
                                                    @foreach(\App\Models\JobListing::TYPES as $type)
                                                        <option value="{{ $type }}" {{ old('job_type', $job->job_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="description" name="description" rows="6">{{ old('description', $job->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <label class="form-label d-block mb-2">Status</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $job->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-job-listing.index') }}" class="btn btn-danger px-4">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>

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
