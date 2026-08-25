{{-- Dynamic "Core Values" rows. Expects $values (array of ['value_name' =>, 'description' =>]). --}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Core Values</label>
        <button type="button" id="addValue" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-2">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th style="width:28%;">Value Name</th>
                    <th>Description</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="valuesBody">
                @forelse($values as $i => $value)
                    <tr class="value-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="values[{{ $i }}][value_name]"
                                value="{{ $value['value_name'] ?? '' }}" placeholder="e.g. Integrity">
                        </td>
                        <td>
                            <textarea class="form-control ckeditor-init" name="values[{{ $i }}][description]" rows="3">{{ $value['description'] ?? '' }}</textarea>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-value">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="value-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="values[0][value_name]"
                                value="" placeholder="e.g. Integrity">
                        </td>
                        <td>
                            <textarea class="form-control ckeditor-init" name="values[0][description]" rows="3"></textarea>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-value">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
