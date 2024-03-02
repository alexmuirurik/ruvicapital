<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" href="/assets/img/logo.png" sizes="180x180">
    <link rel="icon" href="/assets/img/logo.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/assets/img/logo.png" sizes="16x16" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} | Home - https:ruvicapital.com/ </title>
    <link rel="stylesheet" href="/assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <div class="main-wrapper">

        @include('components.sidebar')

        @include('components.nav')

        @yield('content')

        @include('components.footer')
    </div>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/swal/swalalert.min.js"></script>
    <script src="/assets/js/index.js"></script>
</body>
</html>