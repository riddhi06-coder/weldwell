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
                    <div class="col-6"><h4>Edit Clients</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-home-clients.index') }}">Clients</a></li>
                            <li class="breadcrumb-item active">Edit Clients</li>
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
                            <h4>Clients Form</h4>
                            <p class="f-m-light mt-1">Update the section image and client photos (JPG, PNG or WebP, max 2&nbsp;MB each).</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-home-clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label" for="image">Section Image <span class="txt-danger">*</span></label>
                                    <input class="form-control image-input" id="image" type="file" name="image"
                                        accept="image/*" data-preview="#preview_image">
                                    <small class="text-muted">JPG, PNG or WebP · Max 2 MB · Leave empty to keep the current image.</small>
                                    <div class="mt-2">
                                        <img id="preview_image"
                                            src="{{ $client->image ? asset('home/clients/' . $client->image) : '#' }}"
                                            alt="Section image"
                                            style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;{{ $client->image ? '' : 'display:none;' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $client->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                @include('backend.home.clients._clients', ['photos' => $client->photos->pluck('photo')->all()])

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-home-clients.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    @include('backend.home.clients._clients_js')

</body>

</html>
