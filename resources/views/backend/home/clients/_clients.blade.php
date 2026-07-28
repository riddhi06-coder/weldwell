{{-- Dynamic "Clients" photo rows. Expects $photos (array of existing filenames, empty on create). --}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Clients <span class="txt-danger">*</span></label>
        <button type="button" id="addClient" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Client Photo</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="clientsBody">
                @foreach($photos as $photo)
                    <tr class="client-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <img src="{{ asset('home/clients/' . $photo) }}" alt=""
                                style="height:50px;width:auto;border-radius:6px;border:1px solid #eee;">
                            <input type="hidden" name="keep_photos[]" value="{{ $photo }}">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-client">Remove</button>
                        </td>
                    </tr>
                @endforeach

                @if(count($photos) === 0)
                    <tr class="client-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control client-photo-input" type="file" name="new_photos[]" accept="image/*">
                            <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
                            <img class="client-photo-preview mt-2" alt=""
                                style="display:none;height:50px;width:auto;border-radius:6px;border:1px solid #eee;">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-client">Remove</button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
