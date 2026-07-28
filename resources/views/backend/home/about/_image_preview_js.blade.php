<script>
    (function () {
        document.querySelectorAll('.image-input').forEach(function (input) {
            var preview = document.querySelector(input.getAttribute('data-preview'));
            if (!preview) return;

            input.addEventListener('change', function () {
                var file = input.files && input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'inline-block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    })();
</script>
