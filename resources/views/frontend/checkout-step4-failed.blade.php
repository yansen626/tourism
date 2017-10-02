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
                    <li class="done_step2">1. Shipping Address</li>
                    <li class="done_step">2. Delivery</li>
                    <li class="done_step">3. Confirm Order</li>
                    <li class="last active_step">4. Payment</li>
                </ul>

                <div class="checkout_payment clearfix">
                    <div class="payment_method padbot70">
                        <h3 class="checkout_title">Payment Failed <br> please checkout again</h3>

                        <div class="col-md-6">
                            <div class="clear"></div>

                            <a class="btn active center checkout_block_btn" href="{{route ('checkout')}}" >Checkout</a>
                        </div>
                    </div>


                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection