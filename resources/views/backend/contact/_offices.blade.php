{{-- Dynamic office blocks. Expects $offices (array of office data incl. 'image' filename). --}}
<div class="col-12">
    <div class="border rounded p-3">
        <div class="d-flex justify-content-between align-items-center section-bar">
            <h5 class="mb-0">Office Details <span class="txt-danger">*</span></h5>
            <button type="button" id="addOffice" class="btn btn-sm btn-primary">+ Add More</button>
        </div>

        <div id="officesWrap">
            @forelse($offices as $o)
                @php $i = $loop->index; $img = $o['image'] ?? ($o['existing_image'] ?? null); @endphp
                <div class="office-block card border mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 office-title">Office {{ $i + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-office">Remove</button>
                        </div>
                        <div class="row g-4 custom-input">
                            <div class="col-md-4">
                                <label class="form-label">Image <span class="txt-danger">*</span></label>
                                <input class="form-control office-image-input" type="file" name="offices[{{ $i }}][image]" accept="image/*">
                                <input type="hidden" name="offices[{{ $i }}][existing_image]" value="{{ $img }}">
                                <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
                                <div class="mt-2">
                                    <img class="office-preview" src="{{ $img ? asset('contact/offices/' . $img) : '#' }}"
                                        alt="" style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;{{ $img ? '' : 'display:none;' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Office Name <span class="txt-danger">*</span></label>
                                <input class="form-control" type="text" name="offices[{{ $i }}][office_name]"
                                    value="{{ $o['office_name'] ?? '' }}" placeholder="e.g. Head Office">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Telephone No <span class="txt-danger">*</span></label>
                                <input class="form-control" type="text" name="offices[{{ $i }}][telephone]"
                                    value="{{ $o['telephone'] ?? '' }}" placeholder="e.g. +91 22 6646 2000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Emails <span class="txt-danger">*</span></label>
                                <input class="form-control" type="text" name="offices[{{ $i }}][emails]"
                                    value="{{ $o['emails'] ?? '' }}" placeholder="e.g. sales@weldwell.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Map URL <span class="txt-danger">*</span></label>
                                <input class="form-control" type="text" name="offices[{{ $i }}][map_url]"
                                    value="{{ $o['map_url'] ?? '' }}" placeholder="https://maps.google.com/...">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Address <span class="txt-danger">*</span></label>
                                <textarea class="form-control" name="offices[{{ $i }}][address]" rows="2" placeholder="Full address">{{ $o['address'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- one empty office block is added by JS on load --}}
            @endforelse
        </div>
    </div>
</div>
