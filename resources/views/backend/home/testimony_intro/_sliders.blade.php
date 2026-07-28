{{-- Dynamic "Slider Info" rows. Expects $sliders (array of strings). --}}
<div class="col-md-12" style="margin-top:2.5rem;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Slider Info Table</label>
        <button type="button" id="addSlider" class="btn btn-sm btn-primary">+ Add More</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Title</th>
                    <th class="text-center" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody id="slidersBody">
                @forelse($sliders as $slider)
                    <tr class="slider-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="sliders[]"
                                value="{{ $slider }}" placeholder="Enter a title">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-slider">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="slider-row">
                        <td class="row-index text-center"></td>
                        <td>
                            <input class="form-control" type="text" name="sliders[]" value="" placeholder="Enter a title">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-slider">Remove</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
