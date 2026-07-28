{{-- Dynamic "Qualities" rows. Expects $qualities (array of strings). --}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Qualities</label>
        <button type="button" id="addQuality" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-2">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Quality</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="qualitiesBody">
                @forelse($qualities as $quality)
                    <tr class="quality-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="qualities[]"
                                value="{{ $quality }}" placeholder="Enter a quality">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-quality">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="quality-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="qualities[]"
                                value="" placeholder="Enter a quality">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-quality">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
