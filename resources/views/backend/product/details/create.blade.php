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
                    <div class="col-6"><h4>Add Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-product-category-details.index') }}">Product Category Details</a></li>
                            <li class="breadcrumb-item active">Add Details</li>
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
                            <h4>Product Category Details Form</h4>
                            <p class="f-m-light mt-1">Pick a product category and enter the name — the slug is generated automatically.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-product-category-details.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label" for="product_category_id">Product Category <span class="txt-danger">*</span></label>
                                    <select class="form-control" id="product_category_id" name="product_category_id">
                                        <option value="">-- Select a category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="name">Name <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        value="{{ old('name') }}" placeholder="e.g. MIG Welding Machine, TIG Torch">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="image">Image</label>
                                    <input class="form-control image-input" id="image" type="file" name="image"
                                        accept="image/*" data-preview="#preview_image">
                                    <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
                                    <div class="mt-2">
                                        <img id="preview_image" src="#" alt="Image"
                                            style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;display:none;">
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-product-category-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
