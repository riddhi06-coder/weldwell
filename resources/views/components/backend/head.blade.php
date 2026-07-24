 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('admin/assets/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.png') }}" type="image/x-icon">
    <title>Weldwell Speciality Pvt. Ltd. | Welding Consumables, Equipment & Thermal Spray Solutions</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet" type="text/css" media="all"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/quill.bubble.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/datatables.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admin/assets/css/color-1.css') }}" media="screen') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/responsive.css') }}">
    <!-- Hide scrollbars across all admin pages (content stays scrollable) -->
    <style>
        * { scrollbar-width: none; -ms-overflow-style: none; }
        *::-webkit-scrollbar { width: 0; height: 0; display: none; }

        /* ===== Permission matrix (role → permissions) — matches Tata theme (#4A55A2) ===== */
        .perm-matrix { table-layout: fixed; width: 100%; }
        .perm-matrix th,
        .perm-matrix td { padding: .45rem .25rem; font-size: 12px; vertical-align: middle; }
        .perm-matrix thead th {
            font-weight: 600; font-size: 11px; text-transform: uppercase; letter-spacing: .3px;
            background-color: #f4f5fa; color: #4A55A2; border-bottom: 2px solid #e4e7f2; border-top: none;
        }
        .perm-matrix .sec-col { width: auto; word-break: break-word; }
        .perm-matrix .act-col { width: 16%; }
        .perm-card-header { background-color: #f4f5fa; }
        .perm-matrix .form-check-input,
        .perm-card-header .form-check-input {
            width: 17px; height: 17px; margin: 0; float: none;
            border: 1.5px solid #b7bcd1; border-radius: 4px; cursor: pointer;
            transition: border-color .15s ease, background-color .15s ease;
        }
        .perm-matrix .form-check-input:hover,
        .perm-card-header .form-check-input:hover { border-color: #4A55A2; }
        .perm-matrix .form-check-input:checked,
        .perm-card-header .form-check-input:checked { background-color: #4A55A2; border-color: #4A55A2; }
        .perm-matrix .form-check-input:focus,
        .perm-card-header .form-check-input:focus { border-color: #4A55A2; box-shadow: 0 0 0 .18rem rgba(74,85,162,.18); }
    </style>