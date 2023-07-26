<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Company' }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .alert {
            margin-top: 10px;
        }
        body {
            padding-top: 40px;
        }
        .navbar.navbar-fixed-top {
            height: 40px;
        }
    </style>
</head>
<body>
@extends('partials.navBar')

<div class="container mt-5">
    @yield('content')
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
