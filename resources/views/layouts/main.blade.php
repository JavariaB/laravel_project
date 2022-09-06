<!DOCTYPE html>
<html class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Page Title  -->
    <title>@yield('title')</title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('css/dashlite.css?ver=2.9.1') }}">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.includes.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.includes.header')
                <!-- main header @e -->
                <!-- content @s -->
                @yield('home')
                <!-- content @e -->
                <!-- footer @s -->
                @include('layouts.includes.footer')
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('js/scripts.js?ver=2.9.1') }}"></script>
</body>

</html>