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
                    <div class="col-6"><h4>Edit Brand Category</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-brand-category.index') }}">Brand Category</a></li>
                            <li class="breadcrumb-item active">Edit Brand Category</li>
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
                            <h4>Brand Category Form</h4>
                            <p class="f-m-light mt-1">Update the category name — the slug will be regenerated automatically.</p>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-brand-category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label" for="name">Brand Category Name <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        value="{{ old('name', $category->name) }}" placeholder="e.g. Welding Consumables, Equipment & Accessories, Thermal Spray Products">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="title">Title</label>
                                    <input class="form-control" id="title" type="text" name="title"
                                        value="{{ old('title', $category->title) }}" placeholder="Title shown on the home page">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="image">Image</label>
                                    <input class="form-control" id="image" type="file" name="image" accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">JPG, PNG or WebP. Max 2 MB. Leave empty to keep the current image.</small>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="{{ $category->image ? asset('brand/category/' . $category->image) : '#' }}"
                                            alt="{{ $category->name }}"
                                            style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $category->image ? '' : 'display:none;' }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label d-block">Brand Header</label>
                                    <div class="form-check form-switch pt-1">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="show_in_brand_header" name="show_in_brand_header" value="1"
                                            {{ old('show_in_brand_header', $category->show_in_brand_header) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_in_brand_header">Show in Brand header</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label d-block">Product Header</label>
                                    <div class="form-check form-switch pt-1">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="show_in_product_header" name="show_in_product_header" value="1"
                                            {{ old('show_in_product_header', $category->show_in_product_header) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_in_product_header">Show in Product header</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-brand-category.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'inline-block'; };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>
