<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link type="text/css" rel="shortcut icon" href="{{ asset('admin/dist/img/kpum.png') }}" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
    <div class="wrapper" class="pt-5">
        @include('layouts.generalnav')
        <main class="py-5">
            @yield('content')
        </main>
        <footer class="main-footer bg-dark fixed-bottom text-center">
            <strong>Copyright &copy; 2019 - {{ date('Y') }} <a class="text-white" href="{{url('/')}}">KPUM STT Indonesia Tanjungpinang</a>.</strong>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/sparklines/sparkline.js')}}"></script>
    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.js')}}"></script>
    <script src="{{ asset('admin/dist/js/demo.js')}}"></script>
</body>

</html>