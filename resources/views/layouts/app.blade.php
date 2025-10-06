<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="topnav" data-layout-mode="detached">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'UrbNex') }} - @yield('title', 'Gestão de Processos REURB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Vendor CSS -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons CSS -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme Config JS -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Topbar -->
        @include('layouts.partials.topbar')
        <!-- Search Modal -->
        @include('layouts.partials.search-modal')
        <!-- Horizontal Menu -->
        @include('layouts.partials.horizontal-menu')
        <!-- Page Content -->
        <div class="page-content">
            <div class="page-container">
                @yield('content')
            </div>
            <!-- Footer -->
            @include('layouts.partials.footer')
        </div>
        <!-- Theme Settings -->
        @include('layouts.partials.theme-settings')
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    @yield('scripts')
</body>
</html>