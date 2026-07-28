<script>
    (function () {
        var input = document.getElementById('video');
        var wrap = document.getElementById('video-preview-wrap');
        var preview = document.getElementById('video-preview');
        if (!input || !wrap || !preview) return;

        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                wrap.style.display = '';
            } else {
                preview.removeAttribute('src');
                wrap.style.display = 'none';
            }
        });
    })();
</script>
