{{-- Add/remove logic for the Features (number + description) and Industries (name) tables. --}}
<script>
    (function () {
        function makeRepeater(bodyId, addId, rowClass, removeClass, template) {
            var body = document.getElementById(bodyId);
            var addBtn = document.getElementById(addId);
            if (!body || !addBtn) return;

            function renumber() {
                body.querySelectorAll('.' + rowClass + ' .row-index').forEach(function (cell, i) {
                    cell.textContent = i + 1;
                });
            }

            addBtn.addEventListener('click', function () {
                var tr = document.createElement('tr');
                tr.className = rowClass;
                tr.innerHTML = template;
                body.appendChild(tr);
                renumber();
            });

            // Remove a row (event delegation). Always keep at least one row.
            body.addEventListener('click', function (e) {
                if (!e.target.classList.contains(removeClass)) return;
                var rows = body.querySelectorAll('.' + rowClass);
                if (rows.length > 1) {
                    e.target.closest('.' + rowClass).remove();
                } else {
                    e.target.closest('.' + rowClass).querySelectorAll('input').forEach(function (inp) { inp.value = ''; });
                }
                renumber();
            });

            renumber();
        }

        makeRepeater('featuresBody', 'addFeature', 'feature-row', 'remove-feature',
            '<td class="row-index text-center"></td>' +
            '<td><input class="form-control" type="text" name="feature_number[]" value="" placeholder="e.g. 25+ , 90%"></td>' +
            '<td><input class="form-control" type="text" name="feature_description[]" value="" placeholder="Description"></td>' +
            '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-feature">Remove</button></td>');

        makeRepeater('industriesBody', 'addIndustry', 'industry-row', 'remove-industry',
            '<td class="row-index text-center"></td>' +
            '<td><input class="form-control" type="text" name="industry_name[]" value="" placeholder="e.g. Automotive"></td>' +
            '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-industry">Remove</button></td>');
    })();
</script>
