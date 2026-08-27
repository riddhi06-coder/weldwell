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
                    <div class="col-6"><h4>Edit Contact Details</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-contact-details.index') }}">Contact Details</a></li>
                            <li class="breadcrumb-item active">Edit Contact Details</li>
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
                            <h4>Contact Details Form</h4>
                            <p class="f-m-light mt-1">Website contact info, social links and office locations.</p>
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

                            @php
                                $socialsData = old('socials', $contact->socials->map(fn ($s) => [
                                    'platform' => $s->platform, 'url' => $s->url,
                                ])->all() ?: [['platform' => '', 'url' => '']]);

                                $officesData = old('offices', $contact->offices->map(fn ($o) => [
                                    'image' => $o->image, 'office_name' => $o->office_name, 'address' => $o->address,
                                    'emails' => $o->emails, 'telephone' => $o->telephone, 'map_url' => $o->map_url,
                                ])->all());
                            @endphp

                            <form class="row g-4 custom-input" action="{{ route('manage-contact-details.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- ===================== Website Info ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Website Info</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="heading" type="text" name="heading"
                                                    value="{{ old('heading', $contact->heading) }}" placeholder="e.g. Get in Touch">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="address_heading">Address Heading <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="address_heading" type="text" name="address_heading"
                                                    value="{{ old('address_heading', $contact->address_heading) }}" placeholder="e.g. Our Address">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="intro_message">Intro Message <span class="txt-danger">*</span></label>
                                                <textarea class="form-control" id="intro_message" name="intro_message" rows="3" placeholder="Short intro message">{{ old('intro_message', $contact->intro_message) }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="website_intro">Website Intro <span class="txt-danger">*</span></label>
                                                <textarea class="form-control" id="website_intro" name="website_intro" rows="3">{{ old('website_intro', $contact->website_intro) }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="website_address">Website Address <span class="txt-danger">*</span></label>
                                                <textarea class="form-control" id="website_address" name="website_address" rows="3">{{ old('website_address', $contact->website_address) }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="email">Email <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="email" type="email" name="email"
                                                    value="{{ old('email', $contact->email) }}" placeholder="e.g. info@weldwell.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="telephone">Telephone No <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="telephone" type="text" name="telephone"
                                                    value="{{ old('telephone', $contact->telephone) }}" placeholder="e.g. +91 22 6646 2000">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="map_url">Map URL <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="map_url" type="text" name="map_url"
                                                    value="{{ old('map_url', $contact->map_url) }}" placeholder="https://maps.google.com/...">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="iframe_url">iFrame URL <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="iframe_url" type="text" name="iframe_url"
                                                    value="{{ old('iframe_url', $contact->iframe_url) }}" placeholder="https://www.google.com/maps/embed?...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== Sidebar Section ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h5 class="section-title">Sidebar Section</h5>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="sidebar_company_name">Company Name <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="sidebar_company_name" type="text" name="sidebar_company_name"
                                                    value="{{ old('sidebar_company_name', $contact->sidebar_company_name) }}" placeholder="e.g. Weldwell Speciality Pvt. Ltd.">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="sidebar_contact_no">Contact No <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="sidebar_contact_no" type="text" name="sidebar_contact_no"
                                                    value="{{ old('sidebar_contact_no', $contact->sidebar_contact_no) }}" placeholder="e.g. +91 22 6646 2000">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="sidebar_email">Email <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="sidebar_email" type="email" name="sidebar_email"
                                                    value="{{ old('sidebar_email', $contact->sidebar_email) }}" placeholder="e.g. info@weldwell.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="sidebar_website">Website <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="sidebar_website" type="text" name="sidebar_website"
                                                    value="{{ old('sidebar_website', $contact->sidebar_website) }}" placeholder="e.g. www.weldwell.com">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="sidebar_desc">Description <span class="txt-danger">*</span></label>
                                                <textarea class="form-control" id="sidebar_desc" name="sidebar_desc" rows="3" placeholder="Short description">{{ old('sidebar_desc', $contact->sidebar_desc) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('backend.contact._socials', ['socials' => $socialsData])

                                @include('backend.contact._offices', ['offices' => $officesData])

                                {{-- ===================== Status ===================== --}}
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <label class="form-label d-block mb-2">Status</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $contact->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-contact-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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

    @include('backend.contact._contact_js')

</body>

</html>
