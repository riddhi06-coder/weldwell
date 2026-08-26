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
                    <div class="col-6"><h4>Add Customers Served</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-about-customer.index') }}">Customers Served</a></li>
                            <li class="breadcrumb-item active">Add Customers Served</li>
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
                            <h4>Customers Served Form</h4>
                            <p class="f-m-light mt-1">Heading &amp; title, the features list and the highlights list.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-about-customer.store') }}" method="POST">
                                @csrf

                                {{-- ===================== Details ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Details</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="heading" type="text" name="heading"
                                                    value="{{ old('heading') }}" placeholder="e.g. Customers We Serve">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="title">Title</label>
                                                <input class="form-control" id="title" type="text" name="title"
                                                    value="{{ old('title') }}" placeholder="e.g. Trusted across industries">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Features ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Features</h5>
                                        <div class="row g-3">
                                            @include('backend.about.customers._repeater', [
                                                'label'       => 'Features',
                                                'columnLabel' => 'Feature Name',
                                                'name'        => 'features',
                                                'addId'       => 'addFeature',
                                                'bodyId'      => 'featuresBody',
                                                'rowClass'    => 'feature-row',
                                                'removeClass' => 'remove-feature',
                                                'placeholder' => 'Enter a feature',
                                                'rows'        => old('features', ['']),
                                            ])
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Highlights ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="mb-3">Highlights</h5>
                                        <div class="row g-3">
                                            @include('backend.about.customers._repeater', [
                                                'label'       => 'Highlights',
                                                'columnLabel' => 'Highlight Name',
                                                'name'        => 'highlights',
                                                'addId'       => 'addHighlight',
                                                'bodyId'      => 'highlightsBody',
                                                'rowClass'    => 'highlight-row',
                                                'removeClass' => 'remove-highlight',
                                                'placeholder' => 'Enter a highlight',
                                                'rows'        => old('highlights', ['']),
                                            ])
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
                                    <a href="{{ route('manage-about-customer.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.about.customers._repeater_js', [
        'name' => 'features', 'addId' => 'addFeature', 'bodyId' => 'featuresBody',
        'rowClass' => 'feature-row', 'removeClass' => 'remove-feature', 'placeholder' => 'Enter a feature',
    ])
    @include('backend.about.customers._repeater_js', [
        'name' => 'highlights', 'addId' => 'addHighlight', 'bodyId' => 'highlightsBody',
        'rowClass' => 'highlight-row', 'removeClass' => 'remove-highlight', 'placeholder' => 'Enter a highlight',
    ])

</body>

</html>
