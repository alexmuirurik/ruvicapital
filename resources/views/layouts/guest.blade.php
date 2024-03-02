<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} | Home - https:ruvicapital.com/ </title>
    <link rel="apple-touch-icon" href="/assets/img/logo.png" sizes="180x180">
    <link rel="icon" href="/assets/img/logo.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/assets/img/logo.png" sizes="16x16" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/guest.css">
</head>
<body>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/guest.js"></script>
</body>
</html>