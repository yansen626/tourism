<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('css/admin/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('css/admin/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('css/admin/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ URL::asset('css/admin/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('css/admin/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ URL::asset('css/admin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ URL::asset('css/admin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ URL::asset('css/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }} " rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('css/admin/custom.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">





        <!-- page content -->
        @yield('dashboard')
        <!-- /page content -->

        <!-- footer content -->
        @include('admin.partials._footer')
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{ URL::asset('js/admin/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('js/admin/fastclick/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ URL::asset('js/admin/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ URL::asset('js/admin/Chart/Chart.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ URL::asset('js/admin/gauge/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ URL::asset('js/admin/gauge/gauge.min.js') }}"></script>
<script src="{{ URL::asset('js/admin/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('js/admin/iCheck/icheck.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ URL::asset('js/admin/skycons/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ URL::asset('js/admin/Flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('js/admin/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('js/admin/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ URL::asset('js/admin/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ URL::asset('js/admin/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ URL::asset('js/admin/flot.orderbars/jquery.flot.orderBars.js') }}"></script>
<script src="{{ URL::asset('js/admin/flot-spline/jquery.flot.spline.min.js') }}"></script>
<script src="{{ URL::asset('js/admin/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ URL::asset('js/admin/DateJS/date.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('js/admin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('js/admin/jqvmap/jquery.vmap.world.js') }}"></script>
<script src="{{ URL::asset('js/admin/jqvmap/jquery.vmap.sampledata.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ URL::asset('js/admin/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/admin/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- Datatables -->
<script src="{{ URL::asset('css/admin/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ URL::asset('css/admin/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('css/admin/pdfmake/build/vfs_fonts.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ URL::asset('js/admin/custom.min.js') }}"></script>

</body>
</html>
