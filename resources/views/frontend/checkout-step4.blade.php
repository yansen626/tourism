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
                    <li class="active_step last">4. Payment</li>
                </ul>

                {{--<div class="checkout_payment clearfix">--}}
                    {{--<div class="payment_method padbot70">--}}
                        {{--<p class="checkout_title">payment Method</p>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<div class="clear"></div>--}}

                            {{--<a class="btn active pull-left checkout_block_btn" href="{{route ('checkout3Bank')}}" >Bank Transfer</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="clear"></div>--}}

                            {{--<a class="btn active pull-right checkout_block_btn" href="{{route ('checkout3Mid')}}" >Online Payment</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                {{--</div>--}}

                <div class="col-lg-4 col-lg-offset-4 col-md-3 col-md-offset-4 col-xs-12 padbot60 center">

                    <!-- BAG TOTALS -->
                    <div class="widget_bag_totals your_order_block">
                        <h3>Your Order</h3>
                        <table class="bag_total">
                            <tr class="cart-subtotal clearfix">
                                <th>Sub total</th>
                                <td>Rp {{$totalPrice}}</td>
                            </tr>
                            <tr class="shipping clearfix">
                                <th>SHIPPING</th>
                                <td>Rp {{$shipping}}</td>
                            </tr>
                            <tr class="total clearfix">
                                <th>Total</th>
                                <td>Rp {{$grandTotal}}</td>
                            </tr>
                            <tr class="shipping clearfix">
                                <th style="color:red">Payment will be charge as admin fee</th>
                            </tr>
                        </table>
                        <a class="btn active" href="{{route ('checkoutMid')}}" >Pay</a>
                    </div><!-- //REGISTRATION FORM -->
                </div><!-- //SIDEBAR -->
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection