<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Lowids</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{ URL::asset('frontend_images/favicon.ico') }}">
    <link href="{{ URL::asset('css/frontend/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/invoice/invoice-custom.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ URL::asset('css/frontend/datatable/dataTables.bootstrap.min.css') }}" rel="stylesheet">
</head>
    <body>

        @yield('invoice_content')

        <!-- SCRIPTS -->
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if IE]><html class="ie" lang="en"> <![endif]-->

        <script src="{{ URL::asset('js/frontend/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/frontend/bootstrap.min.js') }}"></script>

        <!-- Datatables -->
        <script src="{{ URL::asset('js/frontend/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/frontend/datatable/dataTables.bootstrap.min.js') }}"></script>

    </body>
</html>