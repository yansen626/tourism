

@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb women parallax margbot30">

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
                        <h3>Product Categories</h3>
                        <ul>
                            <li><a href="{{ route('products', ['categoryId' => 0]) }}" >All Category</a></li>
                            @foreach($categories as $category)
                                <li><a href="{{ route('products', ['categoryId' => $category->id]) }}" >{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- //CATEGORIES -->

                    <!-- PRICE RANGE -->
                    <div class="sidepanel widget_pricefilter">
                        <h3>Filter by price</h3>
                        <div id="price-range" class="clearfix">
                            <label for="amount">Range:</label>
                            <input type="text" id="amount"/>
                            <div class="padding-range"><div id="slider-range"></div></div>
                        </div>
                    </div><!-- //PRICE RANGE -->


                    <!-- BANNERS WIDGET -->
                    <div class="widget_banners">
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner10.jpg') }}" alt="" /></a>
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner9.jpg') }}" alt="" /></a>
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner8.jpg') }}" alt="" /></a>
                    </div><!-- //BANNERS WIDGET -->

                </div><!-- //SIDEBAR -->


                <!-- SHOP PRODUCTS -->
                <div class="col-lg-9 col-sm-9 col-sm-9 padbot20">

                    <!-- SHOP BANNER -->
                    <div class="banner_block margbot15">
                        <a class="banner nobord" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner21.jpg') }}" alt="" /></a>
                    </div><!-- //SHOP BANNER -->

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
                            <select class="basic">
                                <option value="">Date</option>
                                <option>Popularity</option>
                                <option>Lowest-Highest Price</option>
                                <option>Highest-Lowest Price</option>
                            </select>
                        </div><!-- //TOVAR FILTER -->

                        <!-- PRODUC SIZE -->
                        <div id="toggle-sizes">
                            <a class="view_box active" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
                            <a class="view_full" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
                        </div><!-- //PRODUC SIZE -->
                    </div><!-- //SORTING TOVAR PANEL -->


                    <!-- ROW -->
                    <div class="row shop_block">

                    @foreach($products as $product)
                        <!-- TOVAR1 -->
                            <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                                <div class="tovar_item clearfix">
                                    <div class="tovar_img">
                                        <div class="tovar_img_wrapper">
                                            <img class="img" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                            <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/1_2.jpg') }}" alt="" />
                                        </div>
                                        <div class="tovar_item_btns">
                                            <a class="add_bag" href="javascript:void(0);" onclick="addToCart('{{ $product->id }}')"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="tovar_description clearfix">
                                        <a class="tovar_title" href="{{ route('product-detail', ['id' => $product->id]) }}" >{{ $product->name }}</a>
                                        <span class="tovar_price">Rp. {{$product->price}}</span>
                                    </div>
                                </div>
                            </div><!-- //TOVAR1 -->
                    @endforeach
                    </div><!-- //ROW -->

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
@endsection

@include('frontend.partials._modal')