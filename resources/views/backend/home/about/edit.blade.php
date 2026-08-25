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
                    <div class="col-6"><h4>Edit About Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-home-about.index') }}">About Details</a></li>
                            <li class="breadcrumb-item active">Edit About Details</li>
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
                            <h4>About Details Form</h4>
                            <p class="f-m-light mt-1">Update the heading, title, images (max 2&nbsp;MB each), intro, description and experience details.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-home-about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="heading" type="text" name="heading"
                                        value="{{ old('heading', $about->heading) }}" placeholder="e.g. About Us">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="experience_title">Experience Title</label>
                                    <input class="form-control" id="experience_title" type="text" name="experience_title"
                                        value="{{ old('experience_title', $about->experience_title) }}" placeholder="e.g. Years of Experience">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="experience">Experience</label>
                                    <input class="form-control" id="experience" type="text" name="experience"
                                        value="{{ old('experience', $about->experience) }}" placeholder="e.g. 25+" inputmode="numeric">
                                    <small class="text-muted">Numbers only, with an optional “+” (e.g. 25+).</small>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="title">Title</label>
                                    <textarea class="form-control ckeditor-init" id="title" name="title" rows="3">{{ old('title', $about->title) }}</textarea>
                                </div>

                                @include('backend.home.about._images', ['about' => $about])

                                <div class="col-md-12">
                                    <label class="form-label" for="small_intro">Small Intro</label>
                                    <textarea class="form-control ckeditor-init" id="small_intro" name="small_intro" rows="3">{{ old('small_intro', $about->small_intro) }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control ckeditor-init" id="description" name="description" rows="5">{{ old('description', $about->description) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $about->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-home-about.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.home.about._image_preview_js')

</body>

</html>
