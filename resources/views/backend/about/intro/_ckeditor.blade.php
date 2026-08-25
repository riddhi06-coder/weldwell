{{--
    CKEditor 5 bootstrapper for the About Introduction module.
    Exposes window.initAboutCKEditor(textarea) / window.destroyAboutCKEditor(textarea)
    so the Vision/Mission repeater can attach an editor to dynamically-added rows.
--}}
<script>
    (function () {
        window.aboutCkEditors = window.aboutCkEditors || new Map();

        var CONFIG = {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link',
                'bulletedList', 'numberedList', '|',
                'alignment', 'outdent', 'indent', '|',
                'undo', 'redo', 'removeFormat'
            ],
            // Make the dropdown labels match the actual tags (Heading 2 => <h2>, etc.).
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            }
        };

        window.initAboutCKEditor = function (textarea) {
            if (!textarea || window.aboutCkEditors.has(textarea) || typeof ClassicEditor === 'undefined') return;
            ClassicEditor.create(textarea, CONFIG)
                .then(function (editor) { window.aboutCkEditors.set(textarea, editor); })
                .catch(function (err) { console.error(err); });
        };

        // Destroy an editor (used before removing a repeater row). Returns a promise.
        window.destroyAboutCKEditor = function (textarea) {
            var editor = window.aboutCkEditors.get(textarea);
            if (editor) {
                window.aboutCkEditors.delete(textarea);
                return editor.destroy().catch(function () {});
            }
            return Promise.resolve();
        };

        function initAll() {
            document.querySelectorAll('.ckeditor-init').forEach(window.initAboutCKEditor);
        }

        document.addEventListener('DOMContentLoaded', function () {
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
        });
    })();
</script>
