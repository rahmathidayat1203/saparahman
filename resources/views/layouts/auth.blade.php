<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SAPA RAHMAN DASHBOARD</title>

    <!-- Skydash CSS -->
    <link rel="stylesheet" href="{{ asset('skydash/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/css/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller">
        @yield('content')
    </div>

    <!-- Skydash JS -->
    <script src="{{ asset('skydash/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('skydash/js/off-canvas.js') }}"></script>
    <script src="{{ asset('skydash/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('skydash/js/template.js') }}"></script>
</body>
</html>
