<!DOCTYPE html>
<html lang="en" dir="">

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{env('APP_NAME')}} | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="/assets/css/themes/lite-purple.min.css" rel="stylesheet" />
    <link href="/assets/css/plugins/perfect-scrollbar.min.css" rel="stylesheet" />
    <!-- fa fa icon -->
    <link href="/assets/css/plugins/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- datatables -->
    <link rel="stylesheet" href="/assets/css/plugins/datatables.min.css" />
    <!-- toastr -->
    <link rel="stylesheet" href="/assets/css/plugins/toastr.css" />
    <!-- sweet alert -->
    <link rel="stylesheet" href="/assets/css/plugins/sweetalert2.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/custom_plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/custom_plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- Datepicker --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    @stack('css')
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-horizontal-bar">
        <div class="main-header">
            <div class="logo"><img src="https://1.bp.blogspot.com/-KBPO2OTYEsY/Xgv5PTMf7NI/AAAAAAAABbE/vDmxGALTm_wE2x50ra5oTMhUYrsYMuVtACLcBGAsYHQ/s1600/Logo%2BUniversitas%2BPelita%2BBangsa.png" alt="" /></div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
            @include('dashboard.layouts.header')
            <!-- header top menu end-->
            @include('dashboard.layouts.navbar')
            <div class="main-content-wrap d-flex flex-column">
                <!-- ============ Body content start ============= -->
                <div class="main-content">
                    @yield('breadcrumb')
                    <div class="separator-breadcrumb border-top"></div>
                    <!-- include main -->
                    @yield('content')
                </div>
                @include('dashboard.layouts.footer')
            </div>
        </div>
        <!-- include mega menu -->
        <!-- ============ Search UI End ============= -->
        <script src="/assets/js/plugins/jquery-3.3.1.min.js"></script>
        <script src="/assets/js/plugins/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/assets/js/scripts/script.min.js"></script>
        <script src="/assets/js/scripts/sidebar-horizontal.script.js"></script>
        <!-- echarts -->
        <script src="/assets/js/plugins/echarts.min.js"></script>
        <script src="/assets/js/scripts/echart.options.min.js"></script>
        <!-- datatables -->
        <script src="/assets/js/plugins/datatables.min.js"></script>
        <!-- <script src="/assets/js/scripts/dashboard.v2.script.min.js"></script> -->
        <!-- toastr -->
        <script src="/assets/js/plugins/toastr.min.js"></script>
        <script src="/assets/js/scripts/toastr.script.min.js"></script>
        <!-- sweet alert -->
        <script src="/assets/js/plugins/sweetalert2.min.js"></script>
        <script src="/assets/js/scripts/sweetalert.script.min.js"></script>
        <!-- Select2 -->
        <script src="/assets/custom_plugins/select2/js/select2.full.min.js"></script>
        {{-- Datepicker --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
        </script>
        @include('dashboard.layouts.global_js')
        @stack('js')
</body>

</html>
