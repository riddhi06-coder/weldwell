<script>
    (function () {
        var body = document.getElementById('slidersBody');
        var addBtn = document.getElementById('addSlider');
        if (!body || !addBtn) return;

        function rowTemplate() {
            var tr = document.createElement('tr');
            tr.className = 'slider-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="sliders[]" value="" placeholder="Enter a title"></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-slider">Remove</button></td>';
            return tr;
        }

        function renumber() {
            body.querySelectorAll('.slider-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            body.appendChild(rowTemplate());
            renumber();
        });

        // Remove a row. Always keep at least one.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-slider')) return;
            var rows = body.querySelectorAll('.slider-row');
            if (rows.length > 1) {
                e.target.closest('.slider-row').remove();
            } else {
                var input = e.target.closest('.slider-row').querySelector('input');
                if (input) input.value = '';
            }
            renumber();
        });

        renumber();
    })();
</script>
