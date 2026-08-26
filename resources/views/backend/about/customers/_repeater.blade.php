{{--
    Generic single-column repeater table. Include with:
      label, columnLabel, name, addId, bodyId, rowClass, removeClass, placeholder, rows (array of strings)
--}}
<div class="col-md-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">{{ $label }}</label>
        <button type="button" id="{{ $addId }}" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-2">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>{{ $columnLabel }}</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="{{ $bodyId }}">
                @forelse($rows as $row)
                    <tr class="{{ $rowClass }}">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="{{ $name }}[]"
                                value="{{ $row }}" placeholder="{{ $placeholder }}">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger {{ $removeClass }}">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="{{ $rowClass }}">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="{{ $name }}[]"
                                value="" placeholder="{{ $placeholder }}">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger {{ $removeClass }}">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
