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
                    <div class="col-6"><h4>Edit Brand List</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-brand-list.index') }}">Brand List</a></li>
                            <li class="breadcrumb-item active">Edit Brand List</li>
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
                            <h4>Brand List Form</h4>
                            <p class="f-m-light mt-1">Update the brand category or name — the slug will be regenerated automatically.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-brand-list.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label" for="main_category_id">Brand Category <span class="txt-danger">*</span></label>
                                    <select class="form-control" id="main_category_id" name="main_category_id">
                                        <option value="">-- Select a category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('main_category_id', $subCategory->main_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="name">Brand Name <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        value="{{ old('name', $subCategory->name) }}" placeholder="e.g. Kemppi (Finland), Hypertherm (USA), Kobelco Welding (Japan)">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="image">Image / Logo</label>
                                    <input class="form-control image-input" id="image" type="file" name="image"
                                        accept="image/*" data-preview="#preview_image">
                                    <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep the current image.</small>
                                    <div class="mt-2">
                                        <img id="preview_image"
                                            src="{{ $subCategory->image ? asset('brand/subcategory/' . $subCategory->image) : '#' }}" alt="Image"
                                            style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $subCategory->image ? '' : 'display:none;' }}">
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-brand-list.index') }}" class="btn btn-danger px-4">Cancel</a>
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
