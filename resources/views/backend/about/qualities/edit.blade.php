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
                    <div class="col-6"><h4>Edit Core Qualities</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-about-qualities.index') }}">Core Qualities</a></li>
                            <li class="breadcrumb-item active">Edit Core Qualities</li>
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
                            <h4>Core Qualities Form</h4>
                            <p class="f-m-light mt-1">Update the header, core values list and the more-info section.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-about-qualities.update', $quality->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- ===================== Header ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Header</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="heading">Heading</label>
                                                <textarea class="form-control ckeditor-init" id="heading" name="heading" rows="3">{{ old('heading', $quality->heading) }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="image">Image</label>
                                                <input class="form-control image-input" id="image" type="file" name="image"
                                                    accept="image/*" data-preview="#preview_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep the current image.</small>
                                                <div class="mt-2">
                                                    <img id="preview_image"
                                                        src="{{ $quality->image ? asset('about/qualities/' . $quality->image) : '#' }}" alt="Image"
                                                        style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;{{ $quality->image ? '' : 'display:none;' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Core Values ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Core Value Section</h5>
                                        <div class="row g-3">
                                            @include('backend.about.qualities._values', [
                                                'values' => old('values', $quality->values->map(fn ($v) => [
                                                    'value_name'  => $v->value_name,
                                                    'description' => $v->description,
                                                ])->all() ?: [['value_name' => '', 'description' => '']]),
                                            ])
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== More Info ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">More Info Section</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="background_image">Background Image</label>
                                                <input class="form-control image-input" id="background_image" type="file" name="background_image"
                                                    accept="image/*" data-preview="#preview_background_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep the current image.</small>
                                                <div class="mt-2">
                                                    <img id="preview_background_image"
                                                        src="{{ $quality->background_image ? asset('about/qualities/' . $quality->background_image) : '#' }}" alt="Background"
                                                        style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;{{ $quality->background_image ? '' : 'display:none;' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="youtube_link">YouTube Video Link</label>
                                                <input class="form-control" id="youtube_link" type="text" name="youtube_link"
                                                    value="{{ old('youtube_link', $quality->youtube_link) }}" placeholder="https://www.youtube.com/watch?v=...">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="more_info_desc">Description</label>
                                                <textarea class="form-control ckeditor-init" id="more_info_desc" name="more_info_desc" rows="4">{{ old('more_info_desc', $quality->more_info_desc) }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="statement">Statement</label>
                                                <textarea class="form-control" id="statement" name="statement" rows="2" placeholder="A short statement">{{ old('statement', $quality->statement) }}</textarea>
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
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $quality->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-about-qualities.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.about.qualities._values_js')
    @include('backend.home.about._image_preview_js')

</body>

</html>
