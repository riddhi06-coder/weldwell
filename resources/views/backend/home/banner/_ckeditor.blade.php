<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editorInstances = new Map();

        function initCKEditor(textarea) {
            if (!textarea || editorInstances.has(textarea) || typeof ClassicEditor === 'undefined') return;
            ClassicEditor.create(textarea, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'link',
                    'bulletedList', 'numberedList', '|',
                    'alignment', 'outdent', 'indent', '|',
                    'undo', 'redo', 'removeFormat'
                ]
            }).then(function (editor) {
                editorInstances.set(textarea, editor);
            }).catch(function (err) { console.error(err); });
        }

        function initAll() {
            document.querySelectorAll('.ckeditor-init').forEach(initCKEditor);
        }

        // CKEditor 5 is loaded from CDN in main-js; wait for it if it isn't ready yet.
        if (typeof ClassicEditor === 'undefined') {
            var tries = 0;
            var wait = setInterval(function () {
                if (typeof ClassicEditor !== 'undefined' || tries++ > 40) {
                    clearInterval(wait);
                    initAll();
                }
            }, 100);
        } else {
            initAll();
        }

        /* ---------- Live video preview ---------- */
        var videoInput = document.getElementById('video');
        var videoPreview = document.getElementById('video-preview');
        if (videoInput && videoPreview) {
            videoInput.addEventListener('change', function () {
                var file = videoInput.files && videoInput.files[0];
                if (file) {
                    videoPreview.src = URL.createObjectURL(file);
                    videoPreview.parentElement.style.display = '';
                }
            });
        }
    });
</script>
