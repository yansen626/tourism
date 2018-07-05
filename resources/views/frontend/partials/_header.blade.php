
<!-- header page-->
<header>
    <!-- site top panel-->
    {{--<div class="site-top-panel">--}}
        {{--<div class="container p-relative">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-6 col-sm-7">--}}
                    {{--<!-- lang select wrapper-->--}}
                    {{--<div class="top-left-wrap font-3">--}}
                        {{--<div class="mail-top"><a href="mailto:support.suntour@example.com"> <i class="flaticon-suntour-email"></i>suntour@example.com</a></div><span>/</span>--}}
                        {{--<div class="tel-top"><a href="tel:(723)-700-1183"> <i class="flaticon-suntour-phone"></i>(723)-700-1183</a></div>--}}
                    {{--</div>--}}
                    {{--<!-- ! lang select wrapper-->--}}
                {{--</div>--}}
                {{--<div class="col-md-6 col-sm-5 text-right">--}}
                    {{--<div class="top-right-wrap">--}}
                        {{--<div class="top-login"><a href="#">My Account</a></div>--}}
                        {{--<div class="curr-wrap dropdown">--}}
                            {{--<div>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="#" class="lang-sel icl-en">Currency<i class="fa fa-angle-down"></i></a>--}}
                                        {{--<ul>--}}
                                            {{--<li><a href="#">USD</a></li>--}}
                                            {{--<li><a href="#">EUR</a></li>--}}
                                            {{--<li> <a href="#">GBP</a></li>--}}
                                            {{--<li> <a href="#">AUD</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="lang-wrap dropdown">--}}
                            {{--<div>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="#" class="lang-sel icl-en">Language <i class="fa fa-angle-down"></i></a>--}}
                                        {{--<ul>--}}
                                            {{--<li><a href="#">English</a></li>--}}
                                            {{--<li> <a href="#">Deutsch</a></li>--}}
                                            {{--<li> <a href="#">Espanol</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- ! site top panel-->
    <!-- Navigation panel-->
    <nav class="main-nav js-stick">
        <div class="full-wrapper relative clearfix container">
            <!-- Logo ( * your text or image into link tag *)-->
            <div class="nav-logo-wrap local-scroll" style="margin-right:0;">
                <a href="{{route('landing')}}" class="logo">
                    <img src="{{ URL::asset('frontend_images/Logo.png') }}"
                         data-at2x="{{ URL::asset('frontend_images/Logo.png') }}">
                </a>
            </div>
            <!-- Main Menu-->
            <div class="inner-nav desktop-nav"  >
                <ul class="clearlist">
                    <!-- Item -->
                    <li><a href="{{route('landing')}}" class="active">Home +</a></li>
                    <!-- End Item -->

                @if(!auth()->guard('travelmates')->check() && !auth()->guard('web')->check())
                    <!-- Item -->
                        <li><a href="{{route('login-travelmate')}}" style="color: #EB5532;">AS TRAVELMATE +</a></li>
                        <!-- End Item -->
                @endif

                    <!-- Item -->
                    <li><a href="{{route('destination')}}" class="mn-has-sub">DESTINATION +</a></li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li><a href="{{route('search')}}" class="mn-has-sub">TAILOR MADE JOURNEY +</a></li>
                    <!-- End Item -->
                    @if(auth()->guard('web')->check())
                        <li><a href="#" class="mn-has-sub">
                                <img style="width: 29px; height: auto;" src="{{ URL::asset('storage/profile/'.\Illuminate\Support\Facades\Auth::guard('web')->user()->img_path) }}">
                                {{ \Illuminate\Support\Facades\Auth::guard('web')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('web')->user()->last_name }}
                            </a>
                            <ul class="mn-sub">
                                <li><a href="{{ route('traveller.transactions', ['flag' => 1]) }}">DASHBOARD</a></li>
                                <li><a href="{{ route('traveller.profile.show') }}">MY PROFILE</a></li>
                                <li><a href="{{route('cart-list')}}">MY CART</a></li>
                                {{--<li><a href="#">CHANGE PASSWORD</a></li>--}}
                                <li><a href="{{ route('logout') }}">LOG OUT</a></li>
                            </ul>
                        </li>
                    @elseif(auth()->guard('travelmates')->check())
                        <li><a href="#" class="mn-has-sub">
                                <img style="width: 29px; height: auto;" src="{{ URL::asset('storage/profile/'.\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->profile_picture) }}">
                                {{ \Illuminate\Support\Facades\Auth::guard('travelmates')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('travelmates')->user()->last_name }}
                            </a>
                            <ul class="mn-sub">
                                <li><a href="{{route('travelmate.packages.index')}}">DASHBOARD</a></li>
                                <li><a href="{{ route('travelmate.profile.show') }}">MY PROFILE</a></li>
                                <li><a href="{{ route('travelmate.packages.index') }}">MY PACKAGES</a></li>
                                {{--<li><a href="#">CHANGE PASSWORD</a></li>--}}
                                <li><a href="{{ route('logout') }}">LOG OUT</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{route('login')}}">REGISTER/LOGIN</a></li>
                    @endif

                    <!-- Search-->
                    <li class="search"><a href="" class="mn-has-sub"> <i class="fa fa-search" style="font-size: 35px;"></i></a>
                        <ul class="search-sub">
                            <li>
                                <div class="container">
                                    <div class="mn-wrap">
                                        <form method="post" class="form">
                                            <div class="search-wrap">
                                                <input type="text" placeholder="Where will you go next?" class="form-control search-field"><i class="flaticon-suntour-search search-icon"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="close-button"><span><i class="fa fa-search" style="font-size: 35px;"></i></span></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- End Search-->
                </ul>
            </div>
            <!-- End Main Menu-->
        </div>
    </nav>
    <!-- End Navigation panel-->
</header>
<!-- ! header page-->