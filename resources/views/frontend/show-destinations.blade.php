@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div style="margin:3%;">
            <h2 class="title-section mb-5">
                <span>Search</span> Destination
                @if($provinceName!= "")
                    <span>of {{$provinceName}}</span>
                @endif
            </h2>
            <div class="search-hotels mb-40 pattern">
                <div class="tours-container">
                    <div class="tours-box">
                        <div class="row">
                            <div class="col-md-6 clearfix">
                                <div class="selection-box">
                                    <select id="province" name="province" class="selectpicker">
                                        <option value="-1">-- SELECT PROVINCE --</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == $provinceId ? 'selected' : '' }} >{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tours-search">
                                    <form method="post" class="form search">
                                        <div class="search-wrap">
                                            <input type="text" placeholder="Travelmate" class="form-control search-field">
                                        </div>
                                    </form>
                                    <div class="button-search">Search</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($packages as $package)
                    <div class="col-md-6">
                        <div class="recom-item border">
                            <div class="recom-media">
                                <a href="hotels-details.html">
                                    <div class="pic">
                                        <img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                             data-at2x="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                             style="max-width: 100%;height: 100%;" alt>
                                    </div>
                                </a>
                                <div class="location"><i class="flaticon-suntour-map"></i> {{$package->province->name}}</div>
                            </div>
                            <!-- Recomended Content-->
                            <div class="recom-item-body"><a href="hotels-details.html">
                                    <h6 class="blog-title">{{$package->name}}</h6></a>
                                <div class="stars stars-4"></div>
                                <div class="recom-price">Rp {{$package->price}}</div>
                                <p class="mb-30">{{$package->description}}</p>
                                <a href="hotels-details.html" class="recom-button">Read more</a>
                                <a href="{{route('cart-list')}}" class="cws-button small alt">Add to cart</a>
                                {{--<div class="action font-2">20%</div>--}}
                            </div>
                            <!-- Recomended Image-->
                        </div>
                    </div>
            @endforeach
                <!-- Recomended item-->
                <!-- ! Recomended item-->
            </div>
        </div>
    </div>

    {{--<div class="content-body">--}}
        {{--<div class="container page">--}}
            {{--<div class="row mb-50">--}}
                {{--<!-- sidebar-->--}}
                {{--<div class="col-md-4 sidebar">--}}
                    {{--<aside class="sb-left pb-50-imp">--}}
                        {{--<!-- widget search-->--}}
                        {{--<div class="cws-widget">--}}
                            {{--<div class="widget-search">--}}
                                {{--<form role="search" method="get" action="#" class="search-form">--}}
                                    {{--<label><span class="screen-reader-text">Search Travelmate</span>--}}
                                        {{--<input type="search" placeholder="Where will you go next?" value="" name="s" title="Search:" class="search-field">--}}
                                    {{--</label>--}}
                                    {{--<button type="submit" class="search-submit"><i class="flaticon-suntour-search"></i></button>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- ! widget search-->--}}

                        {{--<select id="province" name="province" class="selectpicker">--}}
                            {{--<option value="-1">-- SELECT PROVINCE --</option>--}}
                            {{--@foreach($provinces as $province)--}}
                                {{--<option value="{{ $province->id }}">{{ $province->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        {{--<!-- filter price-->--}}
                        {{--<div class="cws-widget">--}}
                            {{--<div class="widget-price-slider">--}}
                                {{--<h2 class="widget-title">Filter By Province</h2>--}}
                                {{--<form method="get" action="#">--}}
                                    {{--<select id="province" name="province" class="selectpicker">--}}
                                        {{--<option value="-1">-- SELECT PROVINCE --</option>--}}
                                        {{--@foreach($provinces as $province)--}}
                                            {{--<option value="{{ $province->id }}">{{ $province->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- ! filter price-->--}}
                        {{--<br>--}}
                        {{--<div class="shop-group clearfix mb-50">--}}
                            {{--<div class="shop-data">--}}
                                {{--<form method="get" class="shop-ordering" style="float:left;">--}}
                                    {{--<select id="province" name="province" class="orderby" style="width:100%;">--}}
                                        {{--<option value="-1">-- SELECT PROVINCE --</option>--}}
                                        {{--@foreach($provinces as $province)--}}
                                            {{--<option value="{{ $province->id }}">{{ $province->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</aside>--}}
                {{--</div>--}}
                {{--<!-- ! sidebar-->--}}
                {{--<!-- content-->--}}
                {{--<div class="col-md-8 list-grid-view">--}}
                    {{--<div class="shop-group clearfix mb-30">--}}
                        {{--<div class="shop-data">--}}
                            {{--<div class="result-count">Showing <span>1</span> to <span>9</span> of <span>25</span> results </div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="cws_divider mb-30"></div>--}}
                    {{--<div class="row products">--}}
                        {{--<!-- Shop item-->--}}
                        {{--@foreach($packages as $package)--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="shop-item">--}}
                                    {{--<!-- Shop Image-->--}}
                                    {{--<div class="shop-media">--}}
                                        {{--<div class="pic">--}}
                                            {{--<img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"--}}
                                                 {{--data-at2x="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"--}}
                                                 {{--style="max-width: 100%;height: auto;" alt>--}}
                                        {{--</div>--}}
                                        {{--<div class="location">{{$package->name}}</div>--}}
                                    {{--</div>--}}
                                    {{--<!-- Shop Content-->--}}
                                    {{--<div class="shop-item-body"><a href="shop-single.html">--}}
                                            {{--<h6 class="shop-title">{{$package->name}}</h6></a>--}}
                                        {{--<div class="stars stars-4"></div>--}}
                                        {{--<div class="shop-price">Rp {{$package->price}} </div>--}}
                                        {{--<p class="mb-30">{{$package->description}}</p>--}}
                                        {{--<a href="shop-single.html" class="shop-button">Read more</a>--}}
                                        {{--<div class="price-review"><a href="#" class="cws-button small alt add-to-cart">add to cart</a><a href="shop-cart.html" class="cws-button small alt added-to-cart">View cart</a></div>--}}
                                        {{--<div class="action font-2">{{$package->price}}</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="link"> <a href="pic/recomended/1.jpg" class="fancy"><i class="fa fa-expand"></i></a></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                        {{--<!-- ! Shop item-->--}}
                    {{--</div>--}}
                    {{--<!-- ! produts-->--}}
                    {{--<div class="cws_divider mb-50 mt-10"></div>--}}
                    {{--<div class="shop-data-bot">--}}
                        {{--<div class="shop-data">--}}
                            {{--<div class="result-count">Showing <span>6</span> Posts of <span>15</span> Pages</div>--}}
                        {{--</div>--}}
                        {{--<!-- pagination-->--}}
                        {{--<nav class="text-right">--}}
                            {{--<ul class="pagination mt-0 mb-0">--}}
                                {{--<li><a href="#" aria-label="Previous"><span class="fa fa-angle-left"></span></a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li><a href="#" class="active">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><a href="#">...</a></li>--}}
                                {{--<li><a href="#">23</a></li>--}}
                                {{--<li><a href="#" aria-label="Next"><span class="fa fa-angle-right"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</nav>--}}
                        {{--<!-- ! pagination-->--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- ! content-->--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection