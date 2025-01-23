<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}">
        <!--===============================================================================================-->	
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animsition/css/animsition.min.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
        <!--===============================================================================================-->	
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
        <!--===============================================================================================-->

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
            <label></label>
        </div>

        @livewireScripts
    </body>
</html>
