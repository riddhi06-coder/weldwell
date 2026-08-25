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
                    <div class="col-6"><h4>Edit Banner</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-home-banner.index') }}">Banner</a></li>
                            <li class="breadcrumb-item active">Edit Banner</li>
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
                            <h4>Banner Form</h4>
                            <p class="f-m-light mt-1">Update the heading, title and (optionally) replace the banner video.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-home-banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                    <textarea class="form-control ckeditor-init" id="heading" name="heading" rows="3">{{ old('heading', $banner->heading) }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                    <textarea class="form-control ckeditor-init" id="title" name="title" rows="3">{{ old('title', $banner->title) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="video">Banner Video</label>
                                    <input class="form-control" id="video" type="file" name="video"
                                        accept="video/mp4,video/webm,video/ogg,video/quicktime">
                                    <small class="text-muted">Leave blank to keep the current video. Allowed: MP4, WebM, OGG, MOV · Max 8 MB</small>

                                    {{-- New selection preview --}}
                                    <div class="mt-2" style="display:none;">
                                        <label class="form-label d-block mb-1">New video preview</label>
                                        <video id="video-preview" width="240" controls class="rounded border"></video>
                                    </div>

                                    @if ($banner->video)
                                        <div class="mt-2">
                                            <label class="form-label d-block mb-1">Current video</label>
                                            <video src="{{ asset('home/banner/'.$banner->video) }}" width="240" controls class="rounded border"></video>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-home-banner.index') }}" class="btn btn-danger px-4">Cancel</a>
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
