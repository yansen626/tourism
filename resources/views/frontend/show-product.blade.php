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
                    <h3><b>other {{$singleProduct->category->name}}</b></h3>

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
                        <h3 class="pull-left"><b>{{$singleProduct->category->name}}</b></h3>

                        <div class="tovar_details_pagination pull-right">
                        </div>
                    </div>

                    <!-- CLEARFIX -->
                    <div class="clearfix padbot40">
                        <div class="tovar_view_fotos clearfix">
                            <div id="slider2" class="flexslider">
                                <ul class="slides">
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_2.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_3.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_4.jpg') }}" alt="" /></a></li>
                                </ul>
                            </div>
                            <div id="carousel2" class="flexslider">
                                <ul class="slides">
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_2.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_3.jpg') }}" alt="" /></a></li>
                                    <li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/women/1_4.jpg') }}" alt="" /></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="tovar_view_description">
                            <div class="tovar_view_title">{{$singleProduct->name}}</div>
                            <div class="tovar_article">&nbsp;</div>
                            <div class="clearfix tovar_brend_price">
                                <div class="pull-left tovar_brend">&nbsp;</div>
                                <div class="pull-right tovar_view_price">Rp {{$singleProduct->price}}</div>
                            </div>
                            <div class="tovar_view_btn">
                                <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i>Add to bag</a>
                                <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div><!-- //CLEARFIX -->

                    <!-- TOVAR INFORMATION -->
                    <div class="tovar_information">
                        <ul class="tabs clearfix">
                            <li class="current">Details</li>
                            <li>Information</li>
                            <li>Reviews (2)</li>
                        </ul>
                        <div class="box visible">
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst. </p>
                        </div>
                        <div class="box">
                            Original Levi 501 <br>
                            Button fly<br>
                            Regular fit<br>
                            waist 28"-32 =16"hem<br>
                            waist 33" = 17" hem<br>
                            waist 34"-40"=18" hem<br>
                            Levi's have started to introduce the red tab with just the (R) (registered trade mark) on the red tab<br><br>

                            Size Details:<br>
                            All sizes from 28-40 waist<br>
                            Leg length 30", 32", 34", 36"
                        </div>
                        <div class="box">
                            <ul class="comments">
                                <li>
                                    <div class="clearfix">
                                        <p class="pull-left"><strong><a href="javascript:void(0);" >John Doe</a></strong></p>
                                        <span class="date">2013-10-09 09:23</span>
                                        <div class="pull-right rating-box clearfix">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</p>
                                </li>
                                <li>
                                    <div class="clearfix">
                                        <p class="pull-left"><strong><a href="javascript:void(0);" >John Doe</a></strong></p>
                                        <span class="date">2013-10-09 09:23</span>
                                        <div class="pull-right rating-box clearfix">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</p>

                                    <ul>
                                        <li>
                                            <p><strong><a href="javascript:void(0);" >Jane Doe</a></strong></p>
                                            <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <h3>WRITE A REVIEW</h3>
                            <p>Now please write a (short) review....(min. 200, max. 2000 characters)</p>
                            <div class="clearfix">
                                <textarea id="review-textarea"></textarea>
                                <label class="pull-left rating-box-label">Your Rate:</label>
                                <div class="pull-left rating-box clearfix">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <input type="submit" class="dark-blue big" value="Submit a review">
                            </div>
                        </div>
                    </div><!-- //TOVAR INFORMATION -->
                </div><!-- //TOVAR DETAILS WRAPPER -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //TOVAR DETAILS -->

    <!-- NEW ARRIVALS -->
    <section class="new_arrivals padbot50">

        <!-- CONTAINER -->
        <div class="container">
            <h2>Recent Products</h2>

            <!-- JCAROUSEL -->
            <div class="jcarousel-wrapper">

                <!-- NAVIGATION -->
                <div class="jCarousel_pagination">
                    <a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
                    <a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
                </div><!-- //NAVIGATION -->

                <div class="jcarousel">
                    <ul>

                        @foreach($recentProducts as $recentProduct)
                            <li>
                                <!-- TOVAR -->
                                <div class="tovar_item_new">
                                    <div class="tovar_img">
                                        <img src="{{ URL::asset('frontend_images/tovar/women/new/1.jpg') }}" alt="" />
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a></div>
                                    </div>
                                    <div class="tovar_description clearfix">
                                        <a class="tovar_title" href="{{ route('product-detail', ['id' => $recentProduct->id]) }}" >{{$recentProduct->name}}</a>
                                        <span class="tovar_price">Rp. {{$recentProduct->price}}</span>
                                    </div>
                                </div><!-- //TOVAR -->
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- //JCAROUSEL -->
        </div><!-- //CONTAINER -->
    </section><!-- //NEW ARRIVALS -->

@endsection
