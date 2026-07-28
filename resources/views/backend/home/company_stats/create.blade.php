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
                    <div class="col-6"><h4>Add Company Stats</h4></div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('manage-company-stats.index') }}">Company Stats</a></li>
                            <li class="breadcrumb-item active">Add Company Stats</li>
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
                            <h4>Company Stats Form</h4>
                            <p class="f-m-light mt-1">Upload a video (MP4, WebM, OGG or MOV, max 8&nbsp;MB) and add the stat rows.</p>
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
                                $rows = [];
                                if (old('stat_no') !== null || old('stat_name') !== null) {
                                    $nos = old('stat_no', []); $names = old('stat_name', []);
                                    $c = max(count($nos), count($names));
                                    for ($i = 0; $i < $c; $i++) {
                                        $rows[] = ['no' => $nos[$i] ?? '', 'name' => $names[$i] ?? ''];
                                    }
                                }
                            @endphp

                            <form class="row g-3 custom-input" action="{{ route('manage-company-stats.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label" for="video">Video <span class="txt-danger">*</span></label>
                                    <input class="form-control" id="video" type="file" name="video"
                                        accept="video/mp4,video/webm,video/ogg,video/quicktime">
                                    <small class="text-muted">Allowed: MP4, WebM, OGG, MOV · Max size: 8 MB</small>

                                    <div class="mt-2" id="video-preview-wrap" style="display:none;">
                                        <video id="video-preview" width="240" controls class="rounded border"></video>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                @include('backend.home.company_stats._stats', ['rows' => $rows])

                                <div class="col-12 text-end">
                                    <a href="{{ route('manage-company-stats.index') }}" class="btn btn-danger px-4">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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

    @include('backend.home.company_stats._stats_js')
    @include('backend.home.company_stats._video_preview_js')

</body>

</html>
