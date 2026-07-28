<script>
    (function () {
        var body = document.getElementById('clientsBody');
        var addBtn = document.getElementById('addClient');
        if (!body || !addBtn) return;

        function rowTemplate() {
            var tr = document.createElement('tr');
            tr.className = 'client-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td>' +
                    '<input class="form-control client-photo-input" type="file" name="new_photos[]" accept="image/*">' +
                    '<small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>' +
                    '<img class="client-photo-preview mt-2" alt="" style="display:none;height:50px;width:auto;border-radius:6px;border:1px solid #eee;">' +
                '</td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-client">Remove</button></td>';
            return tr;
        }

        function renumber() {
            body.querySelectorAll('.client-row .row-index').forEach(function (cell, i) {
                cell.textContent = i + 1;
            });
        }

        addBtn.addEventListener('click', function () {
            body.appendChild(rowTemplate());
            renumber();
        });

        // Remove a row.
        body.addEventListener('click', function (e) {
            if (!e.target.classList.contains('remove-client')) return;
            e.target.closest('.client-row').remove();
            renumber();
        });

        // Live preview for a newly-picked client photo.
        body.addEventListener('change', function (e) {
            if (!e.target.classList.contains('client-photo-input')) return;
            var input = e.target;
            var preview = input.parentElement.querySelector('.client-photo-preview');
            var file = input.files && input.files[0];
            if (preview && file) {
                var reader = new FileReader();
                reader.onload = function (ev) {
                    preview.src = ev.target.result;
                    preview.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);
            }
        });

        renumber();
    })();
</script>
