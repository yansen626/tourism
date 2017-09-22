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
                    <li class="done_step">4. Payment</li>
                </ul>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('checkout2Submit') }}">
                    {{ csrf_field() }}

                    <div class="checkout_delivery clearfix">
                        <p class="checkout_title">CHECKOUT SUCCESS!</p>

                        <a href="{{ route('user-payment-status') }}" class="btn btn-primary">See Payment Status</a>
                    </div>

                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
    <!-- BREADCRUMBS -->
@endsection