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
        .custom-input .section-title {
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .2px;
            padding: 12px 16px;
            margin: -16px -16px 22px -16px;
            border-bottom: 1px solid rgba(128, 128, 128, .2);
            border-left: 4px solid #e5011c;
            border-radius: 8px 8px 0 0;
            background: rgba(128, 128, 128, .18);
        }
    </style>

    @php
        $featureRows = old('feature_number')
            ? collect(old('feature_number'))->map(fn ($n, $i) => ['number' => $n, 'description' => old('feature_description.' . $i)])->all()
            : ($detail->features->map(fn ($f) => ['number' => $f->number, 'description' => $f->description])->all() ?: [['number' => '', 'description' => '']]);

        $industryRows = old('industry_name', $detail->industries->pluck('name')->all() ?: ['']);
    @endphp

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6"><h4>Edit Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-product-category-details.index') }}">Product Category Details</a></li>
                            <li class="breadcrumb-item active">Edit Details</li>
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
                            <p class="f-m-light mt-1">Update the detail page. Leave an image empty to keep the current one.</p>
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

                            <form class="row g-4 custom-input" action="{{ route('manage-product-category-details.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- ===================== Product Category + Banner ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Banner</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="product_category_id">Product Category <span class="txt-danger">*</span></label>
                                                <select class="form-control" id="product_category_id" name="product_category_id">
                                                    <option value="">-- Select a category --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('product_category_id', $detail->product_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="banner_image">Banner Image</label>
                                                <input class="form-control image-input" id="banner_image" type="file" name="banner_image" accept="image/*" data-preview="#preview_banner_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep current.</small>
                                                <div class="mt-2"><img id="preview_banner_image" src="{{ $detail->banner_image ? asset('product/details/banner/' . $detail->banner_image) : '#' }}" alt="Banner" style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $detail->banner_image ? '' : 'display:none;' }}"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="banner_description">Banner Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control" id="banner_description" name="banner_description" rows="2">{{ old('banner_description', $detail->banner_description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Intro Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="section_heading" type="text" name="section_heading" value="{{ old('section_heading', $detail->section_heading) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_image">Section Image</label>
                                                <input class="form-control image-input" id="section_image" type="file" name="section_image" accept="image/*" data-preview="#preview_section_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep current.</small>
                                                <div class="mt-2"><img id="preview_section_image" src="{{ $detail->section_image ? asset('product/details/section/' . $detail->section_image) : '#' }}" alt="Section" style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $detail->section_image ? '' : 'display:none;' }}"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="section_description">Section Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="section_description" name="section_description" rows="4">{{ old('section_description', $detail->section_description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Product Range Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Product Range Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="product_range_title">Section Title <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="product_range_title" type="text" name="product_range_title" value="{{ old('product_range_title', $detail->product_range_title) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="product_range_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="product_range_heading" type="text" name="product_range_heading" value="{{ old('product_range_heading', $detail->product_range_heading) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Knowledge Spectrum Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Knowledge Spectrum Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_title">Section Title <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="knowledge_title" type="text" name="knowledge_title" value="{{ old('knowledge_title', $detail->knowledge_title) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="knowledge_heading" type="text" name="knowledge_heading" value="{{ old('knowledge_heading', $detail->knowledge_heading) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_background_image">Background Image</label>
                                                <input class="form-control image-input" id="knowledge_background_image" type="file" name="knowledge_background_image" accept="image/*" data-preview="#preview_knowledge_background_image">
                                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB. Leave empty to keep current.</small>
                                                <div class="mt-2"><img id="preview_knowledge_background_image" src="{{ $detail->knowledge_background_image ? asset('product/details/knowledge/' . $detail->knowledge_background_image) : '#' }}" alt="Background" style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $detail->knowledge_background_image ? '' : 'display:none;' }}"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_certificate">Certificate</label>
                                                <input class="form-control" id="knowledge_certificate" type="file" name="knowledge_certificate" accept=".pdf,.doc,.docx">
                                                <small class="text-muted">PDF or Word · Max 5 MB. Optional. Leave empty to keep current.</small>
                                                @if($detail->knowledge_certificate)
                                                    <div class="mt-1"><a href="{{ asset('product/details/certificates/' . $detail->knowledge_certificate) }}" target="_blank">View current file</a></div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_brochure">Brochure &amp; Catalogue</label>
                                                <input class="form-control" id="knowledge_brochure" type="file" name="knowledge_brochure" accept=".pdf,.doc,.docx">
                                                <small class="text-muted">PDF or Word · Max 5 MB. Optional. Leave empty to keep current.</small>
                                                @if($detail->knowledge_brochure)
                                                    <div class="mt-1"><a href="{{ asset('product/details/brochures/' . $detail->knowledge_brochure) }}" target="_blank">View current file</a></div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="knowledge_map_url">Manufacturing Locations (Map URL)</label>
                                                <input class="form-control" id="knowledge_map_url" type="text" name="knowledge_map_url" value="{{ old('knowledge_map_url', $detail->knowledge_map_url) }}" placeholder="https://maps.google.com/...">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="knowledge_description">Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="knowledge_description" name="knowledge_description" rows="4">{{ old('knowledge_description', $detail->knowledge_description) }}</textarea>
                                            </div>

                                            {{-- Features table (Number + Description) --}}
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Features</label>
                                                    <button type="button" id="addFeature" class="btn btn-sm btn-primary">+ Add More</button>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:60px;">#</th>
                                                                <th style="width:220px;">Number</th>
                                                                <th>Description</th>
                                                                <th class="text-center" style="width:110px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="featuresBody">
                                                            @foreach($featureRows as $row)
                                                            <tr class="feature-row">
                                                                <td class="row-index text-center"></td>
                                                                <td><input class="form-control" type="text" name="feature_number[]" value="{{ $row['number'] }}" placeholder="e.g. 25+ , 90%"></td>
                                                                <td><input class="form-control" type="text" name="feature_description[]" value="{{ $row['description'] }}" placeholder="Description"></td>
                                                                <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-feature">Remove</button></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Industries Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Industries Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="industries_title">Section Title <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="industries_title" type="text" name="industries_title" value="{{ old('industries_title', $detail->industries_title) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="industries_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="industries_heading" type="text" name="industries_heading" value="{{ old('industries_heading', $detail->industries_heading) }}">
                                            </div>

                                            {{-- Industries served table (Name only) --}}
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Industries Served</label>
                                                    <button type="button" id="addIndustry" class="btn btn-sm btn-primary">+ Add More</button>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:60px;">#</th>
                                                                <th>Industry Name</th>
                                                                <th class="text-center" style="width:110px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="industriesBody">
                                                            @foreach($industryRows as $name)
                                                            <tr class="industry-row">
                                                                <td class="row-index text-center"></td>
                                                                <td><input class="form-control" type="text" name="industry_name[]" value="{{ $name }}" placeholder="e.g. Automotive"></td>
                                                                <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-industry">Remove</button></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Media Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Media Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="media_title">Section Title <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="media_title" type="text" name="media_title" value="{{ old('media_title', $detail->media_title) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="media_heading">Section Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="media_heading" type="text" name="media_heading" value="{{ old('media_heading', $detail->media_heading) }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="media_description">Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="media_description" name="media_description" rows="4">{{ old('media_description', $detail->media_description) }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="media_youtube_url">YouTube Iframe URL <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="media_youtube_url" type="text" name="media_youtube_url" value="{{ old('media_youtube_url', $detail->media_youtube_url) }}" placeholder="https://www.youtube.com/embed/...">
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
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $detail->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-product-category-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    @include('backend.product.details._repeaters_js')

</body>

</html>
