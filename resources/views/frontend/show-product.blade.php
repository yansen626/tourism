@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30"></section>
    <!-- //BREADCRUMBS -->


    <!-- TOVAR DETAILS -->
    <section class="tovar_details padbot70">

        <!-- CONTAINER -->
        <div class="container">

            <!-- ROW -->
            <div class="row">

                <!-- SIDEBAR TOVAR DETAILS -->
                <div class="col-lg-3 col-md-3 sidebar_tovar_details">
                    <h3><b>other {{$product->category->name}}</b></h3>

                    <ul class="tovar_items_small clearfix">
                        @foreach($recommendedProducts as $recommendedProduct)
                            <li class="clearfix">
                                <img class="tovar_item_small_img" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                <a href="{{ route('product-detail', ['id' => $recommendedProduct->id]) }}" class="tovar_item_small_title">{{$recommendedProduct->name}}</a>
                                <span class="tovar_item_small_price">Rp {{$recommendedProduct->price}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- //SIDEBAR TOVAR DETAILS -->

                <!-- TOVAR DETAILS WRAPPER -->
                <div class="col-lg-9 col-md-9 tovar_details_wrapper clearfix">
                    <div class="tovar_details_header clearfix margbot35">
                        <h3 class="pull-left"><b>{{$product->category->name}}</b></h3>

                        <div class="tovar_details_pagination pull-right">
                        </div>
                    </div>

                    <!-- CLEARFIX -->
                    <div class="clearfix padbot40">
                        <div class="tovar_view_fotos clearfix">
                            <div id="slider2" class="flexslider">
                                <ul class="slides">
                                    <li><a href="javascript:void(0);" ><img src="{{ asset('storage\product\\'. $product->product_image()->where('featured', 1)->first()->path) }}" alt="" /></a></li>
                                    @if($photos->count() > 0 )
                                        @foreach($photos as $photo)
                                            <li><a href="javascript:void(0);" ><img src="{{ asset('storage\product\\'. $photo->path) }}" alt="" /></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div id="carousel2" class="flexslider">
                                <ul class="slides">
                                    <li><a href="javascript:void(0);" ><img src="{{ asset('storage\product\\'. $product->product_image()->where('featured', 1)->first()->path) }}" alt="" /></a></li>
                                    @if($photos->count() > 0 )
                                        @foreach($photos as $photo)
                                            <li><a href="javascript:void(0);" ><img src="{{ asset('storage\product\\'. $photo->path) }}" alt="" /></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="tovar_view_description">
                            <div class="tovar_view_title">{{$product->name}}</div>
                            <div class="tovar_article">&nbsp;</div>
                            <div class="clearfix tovar_brend_price">
                                <div class="pull-left tovar_brend">&nbsp;</div>
                                @if(!empty($product->discount) || !empty($product->discount_flat))
                                    <div class="pull-right" style="font-size: 20px;">
                                        <span style="text-decoration: line-through;">Rp {{ $product->price }}</span><br/>
                                        <p style="color:orange;"><b>Rp {{ $product->price_discounted }}</b> <span style="font-size:12px; color:red;">( -{{ $product->discount ? $product->discount. '%' : 'Rp '. $product->discount_flat }} )</span></p>
                                    </div>
                                @else
                                    <div class="pull-right tovar_view_price">Rp {{ $product->price }}</div>
                                @endif
                            </div>
                            <div class="tovar_view_btn">
                                <a class="add_bag" href="javascript:void(0);" onclick="addToCart('{{ $product->id }}')"><i class="fa fa-shopping-cart"></i><span>Add to bag</span></a>
                                <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div><!-- //CLEARFIX -->

                    <!-- TOVAR INFORMATION -->
                    <div class="tovar_information">
                        <ul class="tabs clearfix">
                            <li class="current">Details</li>
                            <li>Information</li>
                        </ul>
                        <div class="box visible">
                            <p>{!! nl2br($product->description) !!}</p>
                        </div>
                        <div class="box">
                            @php( $weightVal = floatval($product->weight / 1000) )
                            Weight: {{ number_format((float) $weightVal, 2, ',', '') }} Kg
                        </div>
                    </div><!-- //TOVAR INFORMATION -->
                </div><!-- //TOVAR DETAILS WRAPPER -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //TOVAR DETAILS -->

    <!-- NEW ARRIVALS -->
    {{--<section class="new_arrivals padbot50">--}}

        {{--<!-- CONTAINER -->--}}
        {{--<div class="container">--}}
            {{--<h2>Recent Products</h2>--}}

            {{--<!-- JCAROUSEL -->--}}
            {{--<div class="jcarousel-wrapper">--}}

                {{--<!-- NAVIGATION -->--}}
                {{--<div class="jCarousel_pagination">--}}
                    {{--<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>--}}
                    {{--<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>--}}
                {{--</div><!-- //NAVIGATION -->--}}

                {{--<div class="jcarousel">--}}
                    {{--<ul>--}}

                        {{--@foreach($recentProducts as $recentProduct)--}}
                            {{--<li>--}}
                                {{--<!-- TOVAR -->--}}
                                {{--<div class="tovar_item_new">--}}
                                    {{--<div class="tovar_img">--}}
                                        {{--<img src="{{ URL::asset('frontend_images/tovar/women/new/1.jpg') }}" alt="" />--}}
                                        {{--<div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a></div>--}}
                                    {{--</div>--}}
                                    {{--<div class="tovar_description clearfix">--}}
                                        {{--<a class="tovar_title" href="{{ route('product-detail', ['id' => $recentProduct->id]) }}" >{{$recentProduct->name}}</a>--}}
                                        {{--<span class="tovar_price">Rp. {{$recentProduct->price}}</span>--}}
                                    {{--</div>--}}
                                {{--</div><!-- //TOVAR -->--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div><!-- //JCAROUSEL -->--}}
        {{--</div><!-- //CONTAINER -->--}}
    {{--</section><!-- //NEW ARRIVALS -->--}}


    <script>
        var urlLink = '{{route('addCart')}}';
    </script>
@endsection

@include('frontend.partials._modal')
