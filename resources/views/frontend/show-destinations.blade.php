@extends('layouts.frontend_2')

@section('body-content')
    <div class="content-body">
        <div class="container page">
            <div class="row mb-50">
                <!-- sidebar-->
                <div class="col-md-4 sidebar">
                    <aside class="sb-left pb-50-imp">
                        <!-- widget search-->
                        <div class="cws-widget">
                            <div class="widget-search">
                                <form role="search" method="get" action="#" class="search-form">
                                    <label><span class="screen-reader-text">Search Travelmate</span>
                                        <input type="search" placeholder="Where will you go next?" value="" name="s" title="Search:" class="search-field">
                                    </label>
                                    <button type="submit" class="search-submit"><i class="flaticon-suntour-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- ! widget search-->

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
                        <!-- ! filter price-->
                        <br>
                        <div class="shop-group clearfix mb-50">
                            <div class="shop-data">
                                <form method="get" class="shop-ordering" style="float:left;">
                                    <select id="province" name="province" class="orderby" style="width:100%;">
                                        <option value="-1">-- SELECT PROVINCE --</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- ! sidebar-->
                <!-- content-->
                <div class="col-md-8 list-grid-view">
                    <div class="shop-group clearfix mb-30">
                        <div class="shop-data">
                            <div class="result-count">Showing <span>1</span> to <span>9</span> of <span>25</span> results </div>
                        </div>
                    </div>
                    <div class="cws_divider mb-30"></div>
                    <div class="row products">
                        <!-- Shop item-->
                        @foreach($packages as $package)
                            <div class="col-md-6">
                                <div class="shop-item">
                                    <!-- Shop Image-->
                                    <div class="shop-media">
                                        <div class="pic">
                                            <img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                                 data-at2x="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                                 style="max-width: 100%;height: auto;" alt>
                                        </div>
                                        <div class="location">{{$package->name}}</div>
                                    </div>
                                    <!-- Shop Content-->
                                    <div class="shop-item-body"><a href="shop-single.html">
                                            <h6 class="shop-title">{{$package->name}}</h6></a>
                                        <div class="stars stars-4"></div>
                                        <div class="shop-price">Rp {{$package->price}} </div>
                                        <p class="mb-30">{{$package->description}}</p>
                                        <a href="shop-single.html" class="shop-button">Read more</a>
                                        <div class="price-review"><a href="#" class="cws-button small alt add-to-cart">add to cart</a><a href="shop-cart.html" class="cws-button small alt added-to-cart">View cart</a></div>
                                        <div class="action font-2">{{$package->price}}</div>
                                    </div>
                                    <div class="link"> <a href="pic/recomended/1.jpg" class="fancy"><i class="fa fa-expand"></i></a></div>
                                </div>
                            </div>
                        @endforeach
                        <!-- ! Shop item-->
                    </div>
                    <!-- ! produts-->
                    <div class="cws_divider mb-50 mt-10"></div>
                    <div class="shop-data-bot">
                        <div class="shop-data">
                            <div class="result-count">Showing <span>6</span> Posts of <span>15</span> Pages</div>
                        </div>
                        <!-- pagination-->
                        <nav class="text-right">
                            <ul class="pagination mt-0 mb-0">
                                <li><a href="#" aria-label="Previous"><span class="fa fa-angle-left"></span></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#" class="active">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">23</a></li>
                                <li><a href="#" aria-label="Next"><span class="fa fa-angle-right"></span></a></li>
                            </ul>
                        </nav>
                        <!-- ! pagination-->
                    </div>
                </div>
                <!-- ! content-->
            </div>
        </div>
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection