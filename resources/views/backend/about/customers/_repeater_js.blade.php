{{--
    Add/remove logic for a generic single-column repeater. Include with:
      name, addId, bodyId, rowClass, removeClass, placeholder
--}}
<script>
    (function () {
        var body = document.getElementById('{{ $bodyId }}');
        var addBtn = document.getElementById('{{ $addId }}');
        if (!body || !addBtn) return;

        function rowTemplate() {
            var tr = document.createElement('tr');
            tr.className = '{{ $rowClass }}';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="{{ $name }}[]" value="" placeholder="{{ $placeholder }}"></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger {{ $removeClass }}">Remove</button></td>';
            return tr;
        }

        // Keep the "#" column numbered after any add/remove.
        function renumber() {
            body.querySelectorAll('.{{ $rowClass }} .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            body.appendChild(rowTemplate());
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('{{ $removeClass }}')) return;
            var rows = body.querySelectorAll('.{{ $rowClass }}');
            if (rows.length > 1) {
                e.target.closest('.{{ $rowClass }}').remove();
            } else {
                var input = e.target.closest('.{{ $rowClass }}').querySelector('input');
                if (input) input.value = '';
            }
            renumber();
        });

        renumber();
    })();
</script>
