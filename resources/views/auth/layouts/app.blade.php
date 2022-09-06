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

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                            @include('auth.layouts.includes.header')
                            @yield('content')
                            </div>
                            <!-- .nk-block -->
                            @include('auth.layouts.includes.footer')
                            <!-- .nk-block -->
                        </div>
                        <!-- .nk-split-content -->
                        @include('auth.layouts.includes.slider')
                        <!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('js/scripts.js?ver=2.9.1') }}"></script>

</html>