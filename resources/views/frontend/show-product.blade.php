@extends('layouts.frontend')

@section('body-content')

    <section class="breadcrumb margbot10"></section>

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
                        @foreach($recommendedProducts as $recProduct)
                            <li class="clearfix">
                                <a href="{{ route('product-detail', ['id' => $recProduct->id]) }}">
                                    <img class="tovar_item_small_img" src="{{ URL::asset('storage\product\\'. $recProduct->product_image()->where('featured', 1)->first()->path) }}" alt="" />
                                </a>
                                <a href="{{ route('product-detail', ['id' => $recProduct->id]) }}" class="tovar_item_small_title">{{$recProduct->name}}</a>
                                {{--<span class="tovar_item_small_price">Rp {{$recProduct->price}}</span>--}}
                                @if(auth()->check())
                                    @if(!empty($recProduct->discount) || !empty($recProduct->discount_flat))
                                        <span style="text-decoration: line-through;">Rp {{ $recProduct->price }}</span><br/>
                                        <p style="color:orange;"><b>Rp {{ $recProduct->price_discounted }}</b></p>
                                    @else
                                        <span class="tovar_item_small_price">Rp {{$recProduct->price_discounted}}</span>
                                    @endif
                                @endif
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

                                {{--@if($product->quantity == 0)--}}
                                    {{--<div class="pull-right tovar_view_price" style="color: red;">Out of Stock!</div>--}}
                                {{--@else--}}
                                    {{--@if(!empty($product->discount) || !empty($product->discount_flat))--}}
                                        {{--<div class="pull-right" style="font-size: 20px;">--}}
                                            {{--<span style="text-decoration: line-through;">Rp {{ $product->price }}</span><br/>--}}
                                            {{--<p style="color:orange;"><b>Rp {{ $product->price_discounted }}</b> <span style="font-size:12px; color:red;">( -{{ $product->discount ? $product->discount. '%' : 'Rp '. $product->discount_flat }} )</span></p>--}}
                                        {{--</div>--}}
                                    {{--@else--}}
                                        {{--<div class="pull-right tovar_view_price">Rp {{ $product->price }}</div>--}}
                                    {{--@endif--}}
                                {{--@endif--}}
                                @if(auth()->check())
                                    @if(!empty($product->discount) || !empty($product->discount_flat))
                                        <div class="pull-right" style="font-size: 20px;">
                                            <span style="text-decoration: line-through;">Rp {{ $product->price }}</span><br/>
                                            <p style="color:orange;"><b><span id="price-label">Rp {{ $product->price_discounted }}</span></b> <span style="font-size:12px; color:red;">( -{{ $product->discount ? $product->discount. '%' : 'Rp '. $product->discount_flat }} )</span></p>
                                        </div>
                                    @else
                                        <div class="pull-right tovar_view_price" id="price-label">Rp {{ $product->price }}</div>
                                    @endif
                                @else
                                    <div style="font-size: 18px;">
                                        <p>Please login first <a href="javascript:void(0);" onclick="loginRedirect()" style="text-decoration: underline;">here</a> to see the price</p>
                                    </div>
                                @endif

                            </div>

                            @if(auth()->check())
                                @if($weights->count() > 0)
                                    <div class="tovar_color_select selection-weight">
                                        <p>Select Weight</p>
                                        <select id="select-weight" class="basic" onchange="onchangeWeight(this)">
                                            @foreach($weights as $weight)
                                                <?php
                                                    $weightNumber = floatval($weight->description);
                                                    $weightNumber = $weightNumber / 1000;
                                                ?>
                                                @if($weight->primary == 1)
                                                    <option data-price="{{ $weight->price }}" data-weight="{{ $weightNumber }}" value="{{ $weight->id }}" selected>{{ $weightNumber }} Kg - Rp {{ $weight->price }}</option>
                                                @else
                                                    <option data-price="{{ $weight->price }}" data-weight="{{ $weightNumber }}" value="{{ $weight->id }}">{{ $weightNumber }} Kg - Rp {{ $weight->price }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($colors->count() > 0)
                                    <div class="tovar_color_select">
                                        <p>Select Color</p>
                                        <select id="select-color" class="basic">
                                            @foreach($colors as $color)
                                                @if($color->primary == 1)
                                                    <option value="{{ $color->id }}" selected>{{ ucwords($color->description) }}</option>
                                                @else
                                                    <option value="{{ $color->id }}">{{ ucwords($color->description) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($sizes->count() > 0)
                                    <div class="tovar_color_select selection-size">
                                        <p>Select Size</p>
                                        <select id="select-size" class="basic" onchange="onchangeSize(this)">
                                            @foreach($sizes as $size)
                                                <?php
                                                    $content = ucwords($size->description);
                                                    if(!empty($size->price)){
                                                        $content .= ' - Rp '. $size->price;
                                                    }

                                                    $sizeWeightNumber = 0;
                                                    if(!empty($size->weight)){
                                                        $sizeWeightNumber = floatval($size->weight);
                                                        $sizeWeightNumber = $sizeWeightNumber / 1000;
                                                    }
                                                ?>
                                                @if($size->primary == 1)
                                                    <option data-price="{{ $size->price ? $size->price : 0 }}" data-weight="{{ $sizeWeightNumber }}"  value="{{ $size->id }}" selected>{{ $content }} @if($sizeWeightNumber != 0) - {{ $sizeWeightNumber }} Kg @endif</option>
                                                @else
                                                    <option data-price="{{ $size->price ? $size->price : 0 }}" data-weight="{{ $sizeWeightNumber }}"  value="{{ $size->id }}">{{ $content }} @if($sizeWeightNumber != 0) - {{ $sizeWeightNumber }} Kg @endif</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if($qtys->count() > 0)
                                    <div class="tovar_color_select selection-qty">
                                        <p>Select Quantity</p>
                                        <select id="select-qty" class="basic" onchange="onchangeQty(this)">
                                            @foreach($qtys as $qty)
                                                <?php
                                                $qtyWeight = floatval($qty->weight);
                                                $qtyWeight = $qtyWeight / 1000;
                                                ?>
                                                @if($qty->primary == 1)
                                                    <option data-price="{{ $qty->price }}" data-weight="{{ $qtyWeight }}" value="{{ $qty->id }}" selected>{{ $qty->description }} - {{ $qtyWeight }} Kg - {{  $qty->price }}</option>
                                                @else
                                                    <option data-price="{{ $qty->price }}" data-weight="{{ $qtyWeight }}" value="{{ $qty->id }}">{{ $qty->description }} - {{ $qtyWeight }} Kg - Rp {{ $qty->price }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="tovar_view_btn">
                                    {{--@if($product->quantity > 0)--}}
                                        {{--<div class="add_bag" onclick="addToCart('{{ $product->id }}')" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i><span>Add to cart</span></div>--}}
                                    {{--@endif--}}
                                    <div class="add_bag" onclick="addToCart('{{ $product->id }}')" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i><span>Add to cart</span></div>
                                </div>
                            @endif
                        </div>
                    </div><!-- //CLEARFIX -->

                    <!-- TOVAR INFORMATION -->
                    <div class="tovar_information">
                        <ul class="tabs clearfix">
                            <li class="current">Description</li>
                            {{--<li>Information</li>--}}
                        </ul>
                        <div class="box visible">
                            @php( $weightVal = floatval($product->weight / 1000) )
                            <p><b><span id="weight-label">Weight: {{ $weightVal }} Kg</span></b></p>
                            <p>{!! nl2br($product->description) !!}</p>
                        </div>
                        {{--<div class="box"></div>--}}
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

    <hr class="container">
    <script>
        var urlLink = '{{route('addCart')}}';
    </script>
    @include('frontend.partials._modal')
@endsection


