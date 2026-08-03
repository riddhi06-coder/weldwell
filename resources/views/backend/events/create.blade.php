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
                    <div class="col-6"><h4>Add Event</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-events.index') }}">Events</a></li>
                            <li class="breadcrumb-item active">Add Event</li>
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
                            <h4>Event Form</h4>
                            <p class="f-m-light mt-1">Add an event — the slug is generated automatically from the title.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-events.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="title" type="text" name="title"
                                        value="{{ old('title') }}" placeholder="e.g. Welding Expo 2025">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="date">Date</label>
                                    <input class="form-control" id="date" type="date" name="date" value="{{ old('date') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="thumbnail">Thumbnail Image <span class="txt-danger">*</span></label>
                                    <input class="form-control image-input" id="thumbnail" type="file" name="thumbnail"
                                        accept="image/*" data-preview="#preview_thumbnail" required>
                                    <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
                                    <div class="mt-2">
                                        <img id="preview_thumbnail" src="#" alt="Thumbnail"
                                            style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;display:none;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="tags">Tags</label>
                                    <input class="form-control" id="tags" type="text" name="tags"
                                        value="{{ old('tags') }}" placeholder="e.g. Welding Expo, Live Demo, Innovation">
                                    <small class="text-muted">Separate multiple tags with commas.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-events.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.home.about._image_preview_js')

</body>

</html>
