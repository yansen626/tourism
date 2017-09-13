@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30"></section>
    <!-- //BREADCRUMBS -->


    <!-- PAGE HEADER -->
    <section class="page_header">

        <!-- CONTAINER -->
        <div class="container border0 margbot0">
            <h3 class="pull-left"><b>Checkout</b></h3>

            <div class="pull-right">
                <a href="{{ route('cart-list') }}" >Back shopping bag<i class="fa fa-angle-right"></i></a>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //PAGE HEADER -->


    <!-- CHECKOUT PAGE -->
    <section class="checkout_page">

        <!-- CONTAINER -->
        <div class="container">

            <!-- CHECKOUT BLOCK -->
            <div class="checkout_block">
                <ul class="checkout_nav">
                    <li class="active_step">1. Shipping Address</li>
                    <li>2. Delivery</li>
                    <li>3. Confirm Order</li>
                    <li class="last">4. Payment</li>
                </ul>

                <form class="checkout_form clearfix" action="javascript:void(0);" method="get">
                    {{--@if($data != null)--}}

                        {{--<div class="checkout_form_input country">--}}
                            {{--<label>Country <span class="color_red">*</span></label>--}}
                            {{--<select class="basic">--}}
                                {{--<option value="">New ZEALaND</option>--}}
                                {{--<option>Australia</option>--}}
                                {{--<option>Hungary</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="clear"></div>--}}

                        {{--<a class="btn active pull-right" href="{{route ('checkout2')}}" >Continue</a>--}}
                    {{--@else--}}
                        {{--<div style="text-align: center;">--}}
                            {{--<h3><b>Add address</b></h3>--}}
                            {{--<br >--}}
                            {{--<a class="btn active" href="{{route ('checkout2')}}" >Add Address</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    <!-- ROW -->
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 padbot60 about_us_description" data-appear-top-offset='-100' data-animated='fadeInLeft'>
                                <p>Nama Penerima</p>
                                <span>Jalan Berlian 3 blok C nomor 4 <br/>
                                    Kecamatan Batu ceper <br/> Kota/Kabupaten Batuceper, <br/>Provinsi Banten, 15122</span>
                                {{--<a class="btn active pull-right" href="{{route ('user/address/edit')}}" >Edit Address</a>--}}
                                <a class="btn active" href="#" >Edit Address</a>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 padbot30" data-appear-top-offset='-100' data-animated='fadeInRight'>
                                <img class="about_img1" src="images/about_img1.jpg" alt="" />
                            </div>
                        </div><!-- //ROW -->

                        <div class="clear"></div>

                        <a class="btn active pull-right" href="{{route ('checkout2')}}" >Continue</a>
                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection
