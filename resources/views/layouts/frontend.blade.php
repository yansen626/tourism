<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home || Elixir Fashion</title>
    <!-- All css Files Here -->
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,500' rel='stylesheet' type='text/css'>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <!-- fontawesome css -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome/font-awesome.min.css') }}" />
    <!-- revolution banner css settings -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('lib/rs-plugin/css/settings.css') }}" media="screen" />
    <!-- style css -->
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/style.css') }}">
    <!-- mobilemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/meanmenu.min.css') }}"/>
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/responsive.css') }}"/>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('frontend_images/favicon.png') }}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

@include('frontend.partials._header')

<!-- Body Here -->
<body>
@yield('body')
</body>

<!-- Footer-Section-Start -->
@include('frontend.partials._footer')
<!-- Footer-Section-End -->

<!-- All js Files Here -->
<!-- jquery-1.11.3 -->
<script src="{{ URL::asset('js/frontend/jquery-1.11.3.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- revolution js -->
<script type="text/javascript" src="{{ URL::asset('lib/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('lib/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ URL::asset('lib/rs-plugin/rs.home.js') }}"></script>
<!-- search-box js -->
<script src="{{ URL::asset('js/frontend/search-box.js') }}"></script>
<!-- scrollUp js -->
<script src="{{ URL::asset('js/frontend/jquery.scrollUp.js') }}"></script>
<!-- mobilemenu js -->
<script src="{{ URL::asset('js/frontend/jquery.meanmenu.js') }}"></script>
<!-- main js -->
<script src="{{ URL::asset('js/frontend/main.js') }}"></script>
</body>
</html>