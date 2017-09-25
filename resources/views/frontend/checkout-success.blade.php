@extends('layouts.frontend')

@section('body-content')

    <section class="breadcrumb parallax margbot30"></section>

    <!-- PAGE HEADER -->
    <section class="page_header">

        <!-- CONTAINER -->
        <div class="container border0 margbot0">
            <h3 class="pull-left"><b>Checkout</b></h3>

            {{--<div class="pull-right">--}}
                {{--<a href="{{ route('cart-list') }}" >Back shopping bag<i class="fa fa-angle-right"></i></a>--}}
            {{--</div>--}}
        </div><!-- //CONTAINER -->
    </section><!-- //PAGE HEADER -->


    <!-- CHECKOUT PAGE -->
    <section class="checkout_page">

        <!-- CONTAINER -->
        <div class="container">

            <!-- CHECKOUT BLOCK -->
            <div class="checkout_block">
                <ul class="checkout_nav">
                    <li class="done_step">1. Shipping Address</li>
                    <li class="done_step">2. Delivery</li>
                    <li class="done_step">3. Confirm Order</li>
                    <li class="done_step" style="border-right: 2px solid #6d9f3b; !important;">4. Payment</li>
                </ul>

                <div class="checkout_delivery clearfix">
                    <h2>CHECKOUT SUCCESS!</h2>
                    @if($paymentMethod == 'credit_card')
                        <p>Your credit card payment has been verified and succesfully confirmed</p>
                        <a href="{{ route('user-order-list') }}" class="btn btn-primary pull-right" style="margin-left: 10px;">See Order Status</a>
                        <a href="{{ route('landing') }}" class="btn btn-primary pull-right">Back to Home</a>
                    @else
                        <p>Your bank transfer payment has been requested</p>
                        <a href="{{ route('user-payment-list') }}" class="btn btn-primary pull-right" style="margin-left: 10px;">See Payment Status</a>
                        <a href="{{ route('landing') }}" class="btn btn-primary pull-right">Back to Home</a>
                    @endif
                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
    <!-- BREADCRUMBS -->
@endsection