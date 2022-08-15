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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.png')}}" />
    @livewireStyles
</head>
<body>
    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar') 
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>           
            </div>
        </div>           
        @include('layouts.inc.admin.footer')  
    </div>    
    <!-- Scripts -->
        <!-- plugins:js -->
        <script src="{{asset('backend/vendors/base/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{asset('backend/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('backend/vendors/datatables.net/jquery.dataTables.js')}}"></script>
        <script src="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{asset('backend/js/off-canvas.js')}}"></script>
        <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('backend/js/template.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{asset('backend/js/dashboard.js')}}"></script>
        <script src="{{asset('backend/js/data-table.js')}}"></script>
        <script src="{{asset('backend/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('backend/js/dataTables.bootstrap4.js')}}"></script>
        <!-- End custom js for this page-->
        <script src="{{asset('backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
        @livewireScripts
        @stack('script')
</body>
</html>