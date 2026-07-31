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
                    <div class="col-6"><h4>Edit Testimonial</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-testimonials.index') }}">Testimonials</a></li>
                            <li class="breadcrumb-item active">Edit Testimonial</li>
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
                            <h4>Testimonial Form</h4>
                            <p class="f-m-light mt-1">Update the client testimonial.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-testimonials.update', $testimonial->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label" for="client_name">Client Name <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="client_name" type="text" name="client_name"
                                        value="{{ old('client_name', $testimonial->client_name) }}" placeholder="e.g. Manufacturing Industry Client">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="industry_type">Industry Type <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="industry_type" type="text" name="industry_type"
                                        value="{{ old('industry_type', $testimonial->industry_type) }}" placeholder="e.g. Automotive Components">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="testimony">Testimony <span class="txt-danger">*</span></label>
                                    <textarea class="form-control ckeditor-init" id="testimony" name="testimony" rows="5">{{ old('testimony', $testimonial->testimony) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-testimonials.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.home.banner._ckeditor')

</body>

</html>
