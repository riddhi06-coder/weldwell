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
                                        <h5 class="mb-3">Website Info</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="website_intro">Website Intro <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="website_intro" name="website_intro" rows="3">{{ old('website_intro', $contact->website_intro) }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="website_address">Website Address <span class="txt-danger">*</span></label>
                                                <textarea class="form-control ckeditor-init" id="website_address" name="website_address" rows="3">{{ old('website_address', $contact->website_address) }}</textarea>
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
