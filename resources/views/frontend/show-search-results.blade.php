

@extends('layouts.frontend-bayu')

@section('body-content')
    <link href="{{ URL::asset('css/frontend/template-btn.css') }}" rel="stylesheet">

    <!-- BREADCRUMBS -->
    <section class="breadcrumb women margbot30" style="background-color: #2c2c2c;">

        <!-- CONTAINER -->
        <div class="container">
            <h2>{{$selectedCategory->name}}</h2>
        </div><!-- //CONTAINER -->
    </section><!-- //BREADCRUMBS -->


    <!-- SHOP BLOCK -->
    <section class="shop">

        <!-- CONTAINER -->
        <div class="container">

            <!-- ROW -->
            <div class="row">

                <!-- SIDEBAR -->
                <div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">

                    <!-- CATEGORIES -->
                    <div class="sidepanel widget_categories">
                        <h3>Filter by category</h3>
                        <div class="form-group">
                            <select id="filter-category" class="form-control" onchange="filterCategory(this)">
                                @if(!empty($filterCategory) && $filterCategory == '-1')
                                    <option value="-1" selected>All Category</option>
                                @else
                                    <option value="-1">All Category</option>
                                @endif
                                @foreach($categories as $category)
                                    @if(!empty($filterCategory) && $filterCategory == strval($category->id))
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- //CATEGORIES -->

                    <!-- PRICE RANGE -->
                    <div class="sidepanel widget_pricefilter">
                        <h3>Filter by price</h3>
                        <div class="form-group">
                            <input type="text" id="max" class="form-control" placeholder="Max" value="{{ $filterMaxPrice ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <input type="text" id="min" class="form-control" placeholder="Min" value="{{ $filterMinPrice ?? '' }}"/>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="filterPrice()">Go</a>
                        </div>
                    </div>
                    <!-- //PRICE RANGE -->

                    <!-- BANNERS WIDGET -->
                    {{--<div class="widget_banners">--}}
                        {{--<a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner10.jpg') }}" alt="" /></a>--}}
                        {{--<a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner9.jpg') }}" alt="" /></a>--}}
                        {{--<a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner8.jpg') }}" alt="" /></a>--}}
                    {{--</div>--}}
                    <!-- //BANNERS WIDGET -->

                </div><!-- //SIDEBAR -->


                <!-- SHOP PRODUCTS -->
                <div class="col-lg-9 col-sm-9 col-sm-9 padbot20">

                    <!-- SHOP BANNER -->
                    {{--<div class="banner_block margbot15">--}}
                        {{--<a class="banner nobord" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner21.jpg') }}" alt="" /></a>--}}
                    {{--</div>--}}
                    <!-- //SHOP BANNER -->

                    <!-- SORTING TOVAR PANEL -->
                    <div class="sorting_options clearfix">

                        <!-- COUNT TOVAR ITEMS -->
                        <div class="count_tovar_items">
                            <p>@if($selectedCategory->count() > 0)
                                    {{$selectedCategory->name}}
                                @else
                                    All Category
                                @endif
                            </p>
                            <span>{{$productCount}} Items</span>
                        </div><!-- //COUNT TOVAR ITEMS -->

                        <!-- TOVAR FILTER -->
                        <div class="product_sort">
                            <p>SORT BY</p>
                            <select id="filter-sort" class="fancy-select" onchange="sortFilter(this)">
                                @if(!empty($filterSort) && $filterSort == '1')
                                    <option value="1" selected>Newest</option>
                                @else
                                    <option value="1">Newest</option>
                                @endif

                                @if(!empty($filterSort) && $filterSort == '2')
                                    <option value="2" selected>Lowest-Highest Price</option>
                                @else
                                    <option value="2">Lowest-Highest Price</option>
                                @endif

                                @if(!empty($filterSort) && $filterSort == '3')
                                    <option value="3" selected>Highest-Lowest Price</option>
                                @else
                                    <option value="3">Highest-Lowest Price</option>
                                @endif

                                @if(!empty($filterSort) && $filterSort == '4')
                                    <option value="4" selected>A-Z</option>
                                @else
                                    <option value="4">A-Z</option>
                                @endif
                            </select>
                        </div>
                        <!-- //TOVAR FILTER -->

                        <!-- PRODUC SIZE -->
                        {{--<div id="toggle-sizes">--}}
                            {{--<a class="view_box active" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>--}}
                            {{--<a class="view_full" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>--}}
                        {{--</div>--}}
                        <!-- //PRODUC SIZE -->
                    </div>
                    <!-- //SORTING TOVAR PANEL -->

                    <!-- ROW -->
                    <div class="row shop_block">

                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                                <div class="tovar_item clearfix">
                                    <div class="tovar_img">
                                        <div class="tovar_img_wrapper">
                                            @if($product->product_image->count() > 0)
                                                <img class="img" src="{{ asset('storage\product\\'. $product->product_image()->where('featured', 1)->first()->path) }}" alt="" />
                                                <img class="img_h" src="{{ asset('storage\product\\'. $product->product_image()->where('featured', 1)->first()->path) }}" alt="" />
                                            @else
                                                <img class="img" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                                <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/1_2.jpg') }}" alt="" />
                                            @endif
                                        </div>
                                        <div class="tovar_item_btns">
                                            <a class="add_bag" href="javascript:void(0);" onclick="addToCart('{{ $product->id }}')"><i class="fa fa-shopping-cart"></i></a>
                                            {{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
                                        </div>
                                    </div>
                                    <div class="tovar_description clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <a class="tovar_title" href="{{ route('product-detail', ['id' => $product->id]) }}" >{{ $product->name }}</a>
                                            </div>
                                            @if(!empty($product->discount) || !empty($product->discount_flat))
                                                <div class="row">
                                                    <span class="tovar_price" style="text-decoration: line-through; font-size: 11px;">Rp {{$product->price}}</span>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <span class="tovar_price" style="color: orange;">Rp {{$product->price_discounted}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <span>No product found</span>
                        </div>
                    @endif
                    </div>
                    <!-- //ROW -->

                    <hr>

                    <div class="clearfix">
                        <!-- PAGINATION -->
                    {!! $products->render() !!}
                    <!-- //PAGINATION -->

                    </div>
                </div><!-- //SHOP PRODUCTS -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //SHOP -->

    <script>
        var urlLink = '{{route('addCart')}}';
    </script>
    @include('frontend.partials._modal')
@endsection
