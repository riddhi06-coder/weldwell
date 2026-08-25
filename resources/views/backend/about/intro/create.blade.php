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
                    <div class="col-6"><h4>Add Introduction Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-about-intro.index') }}">Introduction Details</a></li>
                            <li class="breadcrumb-item active">Add Introduction Details</li>
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
                            <h4>Introduction Details Form</h4>
                            <p class="f-m-light mt-1">Intro heading &amp; image, the vision/mission list and the partner message.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-about-intro.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- ===================== Introduction ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Introduction</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="heading">Intro Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="heading" type="text" name="heading"
                                                    value="{{ old('heading') }}" placeholder="e.g. About Weldwell">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                                <input class="form-control image-input" id="image" type="file" name="image"
                                                    accept="image/*" data-preview="#preview_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
                                                <div class="mt-2">
                                                    <img id="preview_image" src="#" alt="Image"
                                                        style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;display:none;">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="introduction">Introduction</label>
                                                <textarea class="form-control ckeditor-init" id="introduction" name="introduction" rows="4">{{ old('introduction') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Vision & Mission ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Vision &amp; Mission</h5>
                                        <div class="row g-3">
                                            @include('backend.about.intro._visions', [
                                                'visions' => old('visions', [['heading' => '', 'description' => '']]),
                                            ])
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Partner Message ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Partner Message</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="motto_heading">Motto Heading</label>
                                                <input class="form-control" id="motto_heading" type="text" name="motto_heading"
                                                    value="{{ old('motto_heading') }}" placeholder="e.g. Welding a stronger tomorrow">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="motto_description">Description</label>
                                                <textarea class="form-control ckeditor-init" id="motto_description" name="motto_description" rows="4">{{ old('motto_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Status ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <label class="form-label d-block mb-2">Status</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-about-intro.index') }}" class="btn btn-danger px-4">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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

    @include('backend.about.intro._visions_js')
    @include('backend.home.about._image_preview_js')

</body>

</html>
