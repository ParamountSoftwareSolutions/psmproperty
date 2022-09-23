<!DOCTYPE html>
<html lang="en" class="light">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Property Management System</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/panel/assets/img/favicon.ico') }}"/>
    <style>
        .Welcome-section {
            background-image: url(public/panel/assets/img/ppbackgound.png);
        }
    </style>
</head>

<body class="body-custom">
<div class="loader"></div>
<div id="app">
@yield('content')
<!-- END: Register Form -->
</div>

<!-- General JS Scripts -->
<script src="{{ asset('public/panel/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{ asset('public/panel/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('public/panel/assets/js/custom.js') }}"></script>
</body>
</html>
