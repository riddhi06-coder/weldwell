<script>
    (function () {
        var body = document.getElementById('qualitiesBody');
        var addBtn = document.getElementById('addQuality');
        if (!body || !addBtn) return;

        function rowTemplate() {
            var tr = document.createElement('tr');
            tr.className = 'quality-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="qualities[]" value="" placeholder="Enter a quality"></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-quality">Remove</button></td>';
            return tr;
        }

        // Keep the "#" column numbered after any add/remove.
        function renumber() {
            body.querySelectorAll('.quality-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            body.appendChild(rowTemplate());
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-quality')) return;
            var rows = body.querySelectorAll('.quality-row');
            if (rows.length > 1) {
                e.target.closest('.quality-row').remove();
            } else {
                // Last row: just clear its input instead of removing it.
                var input = e.target.closest('.quality-row').querySelector('input');
                if (input) input.value = '';
            }
            renumber();
        });

        renumber();
    })();
</script>
