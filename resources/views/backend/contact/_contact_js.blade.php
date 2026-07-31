@php
    $platformOptionsHtml = '<option value="">— Select Platform —</option>';
    foreach (\App\Models\ContactSocial::PLATFORMS as $key => $p) {
        $platformOptionsHtml .= '<option value="' . $key . '">' . e($p['label']) . '</option>';
    }
@endphp
<script>
    (function () {
        var PLATFORM_OPTIONS = @json($platformOptionsHtml);

        /* ------------------------------- Social media ------------------------------- */
        var socialsBody = document.getElementById('socialsBody');
        var addSocial = document.getElementById('addSocial');
        var socialIndex = socialsBody ? socialsBody.querySelectorAll('.social-row').length : 0;

        function socialRow(idx) {
            var tr = document.createElement('tr');
            tr.className = 'social-row';
            tr.innerHTML =
                '<td class="row-index text-center"></td>' +
                '<td><select class="form-select" name="socials[' + idx + '][platform]">' + PLATFORM_OPTIONS + '</select></td>' +
                '<td><input class="form-control" type="url" name="socials[' + idx + '][url]" value="" placeholder="https://..."></td>' +
                '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-social">Remove</button></td>';
            return tr;
        }

        function renumberSocials() {
            socialsBody.querySelectorAll('.social-row .row-index').forEach(function (c, i) { c.textContent = i + 1; });
        }

        if (addSocial && socialsBody) {
            addSocial.addEventListener('click', function () {
                socialsBody.appendChild(socialRow(socialIndex++));
                renumberSocials();
            });
            socialsBody.addEventListener('click', function (e) {
                if (!e.target.classList.contains('remove-social')) return;
                var rows = socialsBody.querySelectorAll('.social-row');
                if (rows.length > 1) {
                    e.target.closest('.social-row').remove();
                } else {
                    var row = e.target.closest('.social-row');
                    row.querySelector('select').value = '';
                    row.querySelector('input').value = '';
                }
                renumberSocials();
            });
            renumberSocials();
        }

        /* ------------------------------- Offices ------------------------------- */
        var officesWrap = document.getElementById('officesWrap');
        var addOffice = document.getElementById('addOffice');
        var officeIndex = officesWrap ? officesWrap.querySelectorAll('.office-block').length : 0;
        var REQ = ' <span class="txt-danger">*</span>';

        function officeBlock(idx) {
            var div = document.createElement('div');
            div.className = 'office-block card border mb-3';
            div.innerHTML =
                '<div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-center mb-3">' +
                        '<h6 class="mb-0 office-title">Office</h6>' +
                        '<button type="button" class="btn btn-sm btn-danger remove-office">Remove</button>' +
                    '</div>' +
                    '<div class="row g-3 custom-input">' +
                        '<div class="col-md-4">' +
                            '<label class="form-label">Image' + REQ + '</label>' +
                            '<input class="form-control office-image-input" type="file" name="offices[' + idx + '][image]" accept="image/*">' +
                            '<input type="hidden" name="offices[' + idx + '][existing_image]" value="">' +
                            '<small class="text-muted">JPG, PNG or WebP · Max 2 MB.</small>' +
                            '<div class="mt-2"><img class="office-preview" src="#" alt="" style="height:60px;width:auto;border-radius:6px;border:1px solid #eee;display:none;"></div>' +
                        '</div>' +
                        '<div class="col-md-4"><label class="form-label">Office Name' + REQ + '</label><input class="form-control" type="text" name="offices[' + idx + '][office_name]" value="" placeholder="e.g. Head Office"></div>' +
                        '<div class="col-md-4"><label class="form-label">Telephone No' + REQ + '</label><input class="form-control" type="text" name="offices[' + idx + '][telephone]" value="" placeholder="e.g. +91 22 6646 2000"></div>' +
                        '<div class="col-md-6"><label class="form-label">Emails' + REQ + '</label><input class="form-control" type="text" name="offices[' + idx + '][emails]" value="" placeholder="e.g. sales@weldwell.com"></div>' +
                        '<div class="col-md-6"><label class="form-label">Map URL' + REQ + '</label><input class="form-control" type="text" name="offices[' + idx + '][map_url]" value="" placeholder="https://maps.google.com/..."></div>' +
                        '<div class="col-md-12"><label class="form-label">Address' + REQ + '</label><textarea class="form-control" name="offices[' + idx + '][address]" rows="2" placeholder="Full address"></textarea></div>' +
                    '</div>' +
                '</div>';
            return div;
        }

        function renumberOffices() {
            officesWrap.querySelectorAll('.office-block .office-title').forEach(function (t, i) { t.textContent = 'Office ' + (i + 1); });
        }

        if (addOffice && officesWrap) {
            addOffice.addEventListener('click', function () {
                officesWrap.appendChild(officeBlock(officeIndex++));
                renumberOffices();
            });
            officesWrap.addEventListener('click', function (e) {
                if (!e.target.classList.contains('remove-office')) return;
                e.target.closest('.office-block').remove();
                renumberOffices();
            });
            officesWrap.addEventListener('change', function (e) {
                if (!e.target.classList.contains('office-image-input')) return;
                var input = e.target;
                var preview = input.parentElement.querySelector('.office-preview');
                var file = input.files && input.files[0];
                if (preview && file) {
                    var reader = new FileReader();
                    reader.onload = function (ev) { preview.src = ev.target.result; preview.style.display = 'inline-block'; };
                    reader.readAsDataURL(file);
                }
            });
            if (officeIndex === 0) {
                officesWrap.appendChild(officeBlock(officeIndex++));
            }
            renumberOffices();
        }
    })();
</script>
