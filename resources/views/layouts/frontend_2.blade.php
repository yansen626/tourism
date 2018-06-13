<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Travel Mate</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Open Graph -->
    <meta property="og:title" content="Travelmate" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="Travelmate" />

    <link rel="shortcut icon" href="{{ URL::asset('frontend_images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('frontend_images/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/reset.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/fonts/fi/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/flexslider.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/indent.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('rs-plugin/css/settings.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('rs-plugin/css/layers.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('rs-plugin/css/navigation.css') }}">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/frontend/custom.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>

<!-- HEADER -->
@include('frontend.partials._header')
<!-- //HEADER -->

<div class="content-body">
    @yield('body-content')
</div>

<!-- FOOTER -->
@include('frontend.partials._footer')
<!-- //FOOTER -->

<!-- SCRIPTS -->
<script src="https://www.youtube.com/player_api"></script>
<script src="{{ URL::asset('js/frontend/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/bootstrap.js') }}"></script>
<script src="{{ URL::asset('js/frontend/owl.carousel.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery.sticky.js') }}"></script>
<script src="{{ URL::asset('js/frontend/TweenMax.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/cws_parallax.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery.fancybox.pack.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery.fancybox-media.js') }}"></script>
<script src="{{ URL::asset('js/frontend/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/masonry.pkgd.min.js') }}"></script>

<script src="{{ URL::asset('rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ URL::asset('rs-plugin/js/extensions/revolution.extension.migration.min.js') }}"></script>

{{--<script src="{{ URL::asset('js/frontend/jquery.validate.min.js') }}"></script>--}}
{{--<script src="{{ URL::asset('js/frontend/jquery.form.min.js') }}"></script>--}}
<script src="{{ URL::asset('js/frontend/script.js') }}"></script>

{{--<script type="text/javascript" src="js/bg-video/cws_self_vimeo_bg.js"></script>--}}
{{--<script type="text/javascript" src="js/bg-video/jquery.vimeo.api.min.js"></script>--}}
{{--<script type="text/javascript" src="js/bg-video/cws_YT_bg.js"></script>--}}

<script src="{{ URL::asset('js/frontend/jquery.tweet.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery.scrollTo.min.js') }}"></script>
<script src="{{ URL::asset('js/frontend/jquery.flexslider.js') }}"></script>
<script src="{{ URL::asset('js/frontend/retina.min.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3JCAhNj6tVAO_LSb8M-AzMlidiT-RPAs"></script>

@yield('scripts')

</body>
</html>