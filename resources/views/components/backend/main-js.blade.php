<!-- latest jquery-->
<script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('admin/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('admin/assets/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('admin/assets/js/header-slick.js') }}"></script>
    <script src="{{ asset('admin/assets/js/editors/quill.js') }}"></script>
    <script src="{{ asset('admin/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <!-- calendar js-->
    <!-- <script src="{{ asset('admin/assets/js/dashboard/default.js') }}"></script> -->
    <script src="{{ asset('admin/assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('admin/assets/js/height-equal.js') }}"></script>
    <!-- Plugins JS Ends-->

    <script src="{{ asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    
    <!-- Theme js-->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    {{--
        Shared CKEditor 5 bootstrapper (loaded on every admin page via main-js).
          • auto-initialises every <textarea class="ckeditor-init"> present on load, and
          • exposes window.initCKEditor(textarea) / window.destroyCKEditor(textarea)
            so repeaters can attach/detach an editor on dynamically-added rows.
        No per-page include needed — just add class="ckeditor-init" to a textarea.
    --}}
    <script>
        (function () {
            window.wwCkEditors = window.wwCkEditors || new Map();

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

            // Attach an editor to a textarea (no-op if already attached or CKEditor not loaded yet).
            window.initCKEditor = function (textarea) {
                if (!textarea || window.wwCkEditors.has(textarea) || typeof ClassicEditor === 'undefined') return;
                ClassicEditor.create(textarea, CONFIG)
                    .then(function (editor) { window.wwCkEditors.set(textarea, editor); })
                    .catch(function (err) { console.error(err); });
            };

            // Detach an editor (used before removing a repeater row). Returns a promise.
            window.destroyCKEditor = function (textarea) {
                var editor = window.wwCkEditors.get(textarea);
                if (editor) {
                    window.wwCkEditors.delete(textarea);
                    return editor.destroy().catch(function () {});
                }
                return Promise.resolve();
            };

            function initAll() {
                document.querySelectorAll('.ckeditor-init').forEach(window.initCKEditor);
            }

            document.addEventListener('DOMContentLoaded', function () {
                // CKEditor 5 loads from the CDN above; wait for it if it isn't ready yet.
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

                /* ---------- Live video preview (only acts when #video + #video-preview exist) ---------- */
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
        })();
    </script>

    <script>new WOW().init();</script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<script>
  ClassicEditor.create(document.querySelector('#editor'))
    .catch(error => { console.error(error); });
</script>
 

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      height: 200, // Adjust height as needed
      focus: true   // Focus the editor when initialized
    });
  });
</script>



   <!-- Toastr Messages-->
    @if (session('message'))
    <script>
        (function ($) {
            "use strict";
            var notify = $.notify(
                '<i class="fa fa-bell-o"></i><strong>{{ session('message') }}</strong>',
                {
                    type: "theme",
                    allow_dismiss: true,
                    delay: 5000,
                    showProgressbar: true,
                    timer: 300,
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp",
                    },
                }
            );
        })(jQuery);
    </script>
@endif

@if ($errors->any())
    <script>
        (function ($) {
            "use strict";
            var notify = $.notify(
               '<i class="fa fa-bell-o"></i><strong>@foreach ($errors->all() as $error) {{ $error }}<br> @endforeach</strong>',
                {
                    type: "theme",
                    allow_dismiss: true,
                    delay: 5000,
                    showProgressbar: true,
                    timer: 300,
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp",
                    },
                }
            );
        })(jQuery);
    </script>
@endif


