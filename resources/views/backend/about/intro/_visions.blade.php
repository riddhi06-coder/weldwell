{{-- Dynamic "Vision & Mission" rows. Expects $visions (array of ['heading' =>, 'description' =>]). --}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Vision &amp; Mission</label>
        <button type="button" id="addVision" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-2">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th style="width:28%;">Heading</th>
                    <th>Description</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="visionsBody">
                @forelse($visions as $i => $vision)
                    <tr class="vision-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="visions[{{ $i }}][heading]"
                                value="{{ $vision['heading'] ?? '' }}" placeholder="e.g. Our Vision">
                        </td>
                        <td>
                            <textarea class="form-control ckeditor-init" name="visions[{{ $i }}][description]" rows="3">{{ $vision['description'] ?? '' }}</textarea>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-vision">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="vision-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="visions[0][heading]"
                                value="" placeholder="e.g. Our Vision">
                        </td>
                        <td>
                            <textarea class="form-control ckeditor-init" name="visions[0][description]" rows="3"></textarea>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-vision">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
