<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert-dark.css">
    <title>@yield('title')</title>
</head>
<body>
@yield('content')
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
@stack('scripts')
</body>
</html>
