{{-- Dynamic "Stats" rows. Expects $rows (array of ['no' => ..., 'name' => ...]). --}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Stats Table</label>
        <button type="button" id="addStat" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Stats No</th>
                    <th>Stats Name</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="statsBody">
                @forelse($rows as $row)
                    <tr class="stat-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="stat_no[]"
                                value="{{ $row['no'] ?? '' }}" placeholder="e.g. 500+">
                        </td>
                        <td>
                            <input class="form-control" type="text" name="stat_name[]"
                                value="{{ $row['name'] ?? '' }}" placeholder="e.g. Projects Completed">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-stat">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="stat-row">
                        <td class="row-index text-center"></td>
                        <td><input class="form-control" type="text" name="stat_no[]" value="" placeholder="e.g. 500+"></td>
                        <td><input class="form-control" type="text" name="stat_name[]" value="" placeholder="e.g. Projects Completed"></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-stat">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
