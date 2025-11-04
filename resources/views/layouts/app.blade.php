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
    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons CSS -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Notify js CSS -->
    <link href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" rel="stylesheet" />
    <!-- Tom Select CSS -->
    <link href="{{ asset('assets/vendor/tom-select/tom-select.css') }}" rel="stylesheet">
    <!-- Theme Config JS -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Google+Sans:400,500,700|Google+Sans+Text:400,400italic,500,500italic,700,700italic|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700&amp;display=swap">
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
    <!-- Notify js -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Tom Select js -->
    <script src="{{ asset('assets/vendor/tom-select/tom-select.complete.min.js') }}"></script>
    <!-- Tom Select Helper -->
    <script src="{{ asset('assets/js/helpers/tom-select-helper.js') }}"></script>
    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        // Instância global do Notyf
        const notyf = new Notyf({
            duration: 5000,
            position: { x: 'right', y: 'top' },
            dismissible: false,
            types: [
                {
                    type: 'warning',
                    background: '#f59e0b',
                    icon: {
                        className: 'ri-error-warning-line',
                        tagName: 'i',
                        text: 'warning'
                    }
                },
                {
                    type: 'error',
                    background: '#ef4444',
                    icon: {
                        className: 'ri-close-circle-line',
                        tagName: 'i',
                        text: 'error'
                    }
                },
                {
                    type: 'success',
                    background: '#22c55e',
                    icon: {
                        className: 'ri-check-line',
                        tagName: 'i',
                        text: 'check_circle'
                    }
                }
            ]
        });

        // Mensagens de sessão (Laravel)
        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('warning'))
            notyf.open({ type: 'warning', message: "{{ session('warning') }}" });
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    @yield('scripts')
</body>
</html>