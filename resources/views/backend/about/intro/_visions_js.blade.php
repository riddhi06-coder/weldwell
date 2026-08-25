{{-- Add/remove rows for the Vision & Mission table, wiring CKEditor onto each new row. --}}
<script>
    (function () {
        var body = document.getElementById('visionsBody');
        var addBtn = document.getElementById('addVision');
        if (!body || !addBtn) return;

        // Next array index for new rows — kept unique so nothing collides on submit.
        var index = body.querySelectorAll('.vision-row').length;

        function rowTemplate(i) {
            var tr = document.createElement('tr');
            tr.className = 'vision-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="visions[' + i + '][heading]" value="" placeholder="e.g. Our Vision"></td>' +
                '<td><textarea class="form-control ckeditor-init" name="visions[' + i + '][description]" rows="3"></textarea></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-vision">Remove</button></td>';
            return tr;
        }

        // Keep the "#" column numbered after any add/remove.
        function renumber() {
            body.querySelectorAll('.vision-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            var tr = rowTemplate(index++);
            body.appendChild(tr);
            var ta = tr.querySelector('.ckeditor-init');
            if (window.initAboutCKEditor) window.initAboutCKEditor(ta);
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-vision')) return;

            var row  = e.target.closest('.vision-row');
            var ta   = row.querySelector('.ckeditor-init');
            var last = body.querySelectorAll('.vision-row').length <= 1;

            // Destroy the editor first so it releases the (soon-to-be-gone) DOM cleanly.
            var destroyed = (ta && window.destroyAboutCKEditor) ? window.destroyAboutCKEditor(ta) : Promise.resolve();

            destroyed.then(function () {
                if (!last) {
                    row.remove();
                } else {
                    // Last row: clear its fields instead of removing it.
                    var input = row.querySelector('input');
                    if (input) input.value = '';
                    if (ta) {
                        ta.value = '';
                        if (window.initAboutCKEditor) window.initAboutCKEditor(ta);
                    }
                }
                renumber();
            });
        });

        renumber();
    })();
</script>
