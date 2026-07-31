{{-- Dynamic social-media rows (platform dropdown + url). Expects $socials (array of ['platform'=>,'url'=>]). --}}
<div class="col-12">
    <div class="border rounded p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Social Media <span class="txt-danger">*</span></h5>
            <button type="button" id="addSocial" class="btn btn-sm btn-primary">+ Add More</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th style="width:32%;">Platform <span class="txt-danger">*</span></th>
                        <th>URL <span class="txt-danger">*</span></th>
                        <th class="text-center" style="width:110px;">Action</th>
                    </tr>
                </thead>
                <tbody id="socialsBody">
                    @forelse($socials as $s)
                        <tr class="social-row">
                            <td class="row-index text-center"></td>
                            <td>
                                <select class="form-select" name="socials[{{ $loop->index }}][platform]">
                                    <option value="">— Select Platform —</option>
                                    @foreach(\App\Models\ContactSocial::PLATFORMS as $key => $p)
                                        <option value="{{ $key }}" {{ ($s['platform'] ?? '') === $key ? 'selected' : '' }}>{{ $p['label'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="form-control" type="url" name="socials[{{ $loop->index }}][url]"
                                    value="{{ $s['url'] ?? '' }}" placeholder="https://...">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger remove-social">Remove</button>
                            </td>
                        </tr>
                    @empty
                        <tr class="social-row">
                            <td class="row-index text-center"></td>
                            <td>
                                <select class="form-select" name="socials[0][platform]">
                                    <option value="">— Select Platform —</option>
                                    @foreach(\App\Models\ContactSocial::PLATFORMS as $key => $p)
                                        <option value="{{ $key }}">{{ $p['label'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input class="form-control" type="url" name="socials[0][url]" value="" placeholder="https://..."></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-social">Remove</button></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
