{{-- Add/remove rows for the Core Values table, wiring CKEditor onto each new row. --}}
<script>
    (function () {
        var body = document.getElementById('valuesBody');
        var addBtn = document.getElementById('addValue');
        if (!body || !addBtn) return;

        // Next array index for new rows — kept unique so nothing collides on submit.
        var index = body.querySelectorAll('.value-row').length;

        function rowTemplate(i) {
            var tr = document.createElement('tr');
            tr.className = 'value-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="values[' + i + '][value_name]" value="" placeholder="e.g. Integrity"></td>' +
                '<td><textarea class="form-control ckeditor-init" name="values[' + i + '][description]" rows="3"></textarea></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-value">Remove</button></td>';
            return tr;
        }

        // Keep the "#" column numbered after any add/remove.
        function renumber() {
            body.querySelectorAll('.value-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            var tr = rowTemplate(index++);
            body.appendChild(tr);
            var ta = tr.querySelector('.ckeditor-init');
            if (window.initCKEditor) window.initCKEditor(ta);
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-value')) return;

            var row  = e.target.closest('.value-row');
            var ta   = row.querySelector('.ckeditor-init');
            var last = body.querySelectorAll('.value-row').length <= 1;

            // Destroy the editor first so it releases the (soon-to-be-gone) DOM cleanly.
            var destroyed = (ta && window.destroyCKEditor) ? window.destroyCKEditor(ta) : Promise.resolve();

            destroyed.then(function () {
                if (!last) {
                    row.remove();
                } else {
                    // Last row: clear its fields instead of removing it.
                    var input = row.querySelector('input');
                    if (input) input.value = '';
                    if (ta) {
                        ta.value = '';
                        if (window.initCKEditor) window.initCKEditor(ta);
                    }
                }
                renumber();
            });
        });

        renumber();
    })();
</script>
