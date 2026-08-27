{{-- Add/remove logic for the Benefits (benefit + description) table. --}}
<script>
    (function () {
        var body = document.getElementById('benefitsBody');
        var addBtn = document.getElementById('addBenefit');
        if (!body || !addBtn) return;

        function renumber() {
            body.querySelectorAll('.benefit-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            var tr = document.createElement('tr');
            tr.className = 'benefit-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><input class="form-control" type="text" name="benefit[]" value="" placeholder="e.g. Health Insurance"></td>' +
                '<td><textarea class="form-control" name="benefit_description[]" rows="2" placeholder="Description"></textarea></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-benefit">Remove</button></td>';
            body.appendChild(tr);
            renumber();
        });

        // Remove a row (event delegation). Always keep at least one row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-benefit')) return;
            var rows = body.querySelectorAll('.benefit-row');
            if (rows.length > 1) {
                e.target.closest('.benefit-row').remove();
            } else {
                e.target.closest('.benefit-row').querySelectorAll('input, textarea').forEach(function (inp) { inp.value = ''; });
            }
            renumber();
        });

        renumber();
    })();
</script>
