<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
</head>

<body>
    @include('components.backend.header')
    @include('components.backend.sidebar')

    <style>
        /* Highlighted section header bar inside each bordered section box. */
        .custom-input .section-title,
        .custom-input .section-bar {
            padding: 12px 16px;
            margin: -16px -16px 22px -16px;
            border-bottom: 1px solid rgba(128, 128, 128, .2);
            border-left: 4px solid #e5011c;
            border-radius: 8px 8px 0 0;
            background: rgba(128, 128, 128, .18);
        }
        .custom-input .section-title { font-size: 15px; font-weight: 600; letter-spacing: .2px; }
        .custom-input .section-bar h5 { font-size: 15px; font-weight: 600; }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6"><h4>Add Career Page Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-career-page-details.index') }}">Career Page Details</a></li>
                            <li class="breadcrumb-item active">Add Career Page Details</li>
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
                            <h4>Career Page Details Form</h4>
                            <p class="f-m-light mt-1">Banner, benefits and section content for the careers page.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-career-page-details.store') }}" method="POST">
                                @csrf

                                {{-- ===================== Banner ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Banner</h5>
                                        <div class="row g-4">
                                            <div class="col-md-12">
                                                <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                                    value="{{ old('banner_heading') }}" placeholder="e.g. Build Your Career With Weldwell">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Benefits ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-center section-bar">
                                            <h5 class="mb-0">Benefits</h5>
                                            <button type="button" id="addBenefit" class="btn btn-sm btn-primary">+ Add More</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th style="width:60px;">#</th>
                                                        <th style="width:280px;">Benefit</th>
                                                        <th>Description</th>
                                                        <th class="text-center" style="width:110px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="benefitsBody">
                                                    @php $benefitRows = old('benefit', ['']); @endphp
                                                    @foreach($benefitRows as $i => $b)
                                                    <tr class="benefit-row">
                                                        <td class="row-index text-center"></td>
                                                        <td><input class="form-control" type="text" name="benefit[]" value="{{ $b }}" placeholder="e.g. Health Insurance"></td>
                                                        <td><textarea class="form-control" name="benefit_description[]" rows="2" placeholder="Description">{{ old('benefit_description.'.$i) }}</textarea></td>
                                                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-benefit">Remove</button></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="section_heading" type="text" name="section_heading" value="{{ old('section_heading') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="career_heading">Career Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="career_heading" type="text" name="career_heading" value="{{ old('career_heading') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}">
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
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-career-page-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    @include('backend.careers.page_details._benefits_js')

</body>

</html>
