{{-- Three image uploads with live preview. Expects $about (nullable HomeAbout). --}}
@foreach (['image1' => 'Image 1', 'image2' => 'Image 2', 'image3' => 'Image 3'] as $field => $label)
    @php $existing = $about?->{$field}; @endphp
    <div class="col-md-4">
        <label class="form-label" for="{{ $field }}">{{ $label }}</label>
        <input class="form-control image-input" id="{{ $field }}" type="file" name="{{ $field }}"
            accept="image/*" data-preview="#preview_{{ $field }}">
        <small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>
        <div class="mt-2">
            <img id="preview_{{ $field }}"
                src="{{ $existing ? asset('home/about/' . $existing) : '#' }}"
                alt="{{ $label }}"
                style="height:70px;width:auto;border-radius:6px;border:1px solid #eee;{{ $existing ? '' : 'display:none;' }}">
        </div>
    </div>
@endforeach
