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
                    <div class="col-6"><h4>Edit Product Sub Category</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-product-subcategory.index') }}">Product Sub Category</a></li>
                            <li class="breadcrumb-item active">Edit Product Sub Category</li>
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
                            <h4>Product Sub Category Form</h4>
                            <p class="f-m-light mt-1">Update the parent category, name or short description — the slug regenerates when the name changes.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-product-subcategory.update', $subCategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="product_category_id">Product Category <span class="txt-danger">*</span></label>
                                                <select class="form-control" id="product_category_id" name="product_category_id">
                                                    <option value="">-- Select a category --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('product_category_id', $subCategory->product_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="name">Sub Category Name <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="name" type="text" name="name"
                                                    value="{{ old('name', $subCategory->name) }}" placeholder="e.g. MIG Welding Wires">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="short_description">Short Description</label>
                                                <textarea class="form-control ckeditor-init" id="short_description" name="short_description" rows="4">{{ old('short_description', $subCategory->short_description) }}</textarea>
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
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $subCategory->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-product-subcategory.index') }}" class="btn btn-danger px-4">Cancel</a>
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
