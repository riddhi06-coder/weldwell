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
                            <li class="breadcrumb-item"><a href="{{ route('manage-brand-catgeory.index') }}">Brand Category</a></li>
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

                            <form class="row g-3 custom-input" action="{{ route('manage-brand-catgeory.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <label class="form-label" for="name">Category Name <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="name" type="text" name="name"
                                        value="{{ old('name', $category->name) }}" placeholder="e.g. Welding Consumables, Equipment & Accessories, Thermal Spray Products">
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-brand-catgeory.index') }}" class="btn btn-danger px-4">Cancel</a>
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
