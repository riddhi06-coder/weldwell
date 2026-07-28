<script>
    (function () {
        var body = document.getElementById('statsBody');
        var addBtn = document.getElementById('addStat');
        if (!body || !addBtn) return;

        function rowTemplate() {
            var tr = document.createElement('tr');
            tr.className = 'stat-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="stat_no[]" value="" placeholder="e.g. 500+"></td>' +
                '<td><input class="form-control" type="text" name="stat_name[]" value="" placeholder="e.g. Projects Completed"></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-stat">Remove</button></td>';
            return tr;
        }

        // Keep the "#" column numbered after any add/remove.
        function renumber() {
            body.querySelectorAll('.stat-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            body.appendChild(rowTemplate());
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-stat')) return;
            var rows = body.querySelectorAll('.stat-row');
            if (rows.length > 1) {
                e.target.closest('.stat-row').remove();
            } else {
                // Last row: just clear its inputs instead of removing it.
                e.target.closest('.stat-row').querySelectorAll('input').forEach(function (i) { i.value = ''; });
            }
            renumber();
        });

        renumber();
    })();
</script>
