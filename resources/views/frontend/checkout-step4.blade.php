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
                <div class="row">

                    <form class="form-horizontal" id="myForm" role="form" method="POST" action="{{ route('checkoutMid') }}">
                        {{ csrf_field() }}
                    <div class="col-lg-9 col-md-9 padbot60">
                        <div class="checkout_delivery clearfix">
                            <p class="checkout_title">PAYMENT METHOD</p>
                            <ul>
                                <li>
                                    <input id="ridio1" type="radio" name="shippingRadio" hidden value="bank_transfer" onchange="handleChangePayment(this);" />
                                    <label for="ridio1"><b>Bank Transfer</b></label>
                                </li>

                                <li>
                                    <input id="ridio2" type="radio" name="shippingRadio" hidden value="credit_card" onchange="handleChangePayment(this);" />
                                    <label for="ridio2"><b>Credit Card</b></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 padbot60">

                        <!-- BAG TOTALS -->
                        <div class="sidepanel widget_bag_totals your_order_block">
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
                                <tr class="shipping clearfix">
                                    <input type="hidden" id="selected-fee" name="selected-fee" value="0">
                                    <th>ADMIN</th>
                                    <td id="admin-fee">Rp 0</td>
                                </tr>
                                <tr class="total clearfix">
                                    <input type="hidden" id="grand-total-value" value="{{$grandTotal}}">
                                    <th>Total</th>
                                    <td id="grand-total-price">Rp {{$grandTotal}}</td>
                                </tr>
                                <tr class="shipping clearfix">
                                    <th style="color:red">Payment will be charge as admin fee</th>
                                </tr>
                            </table>
                            <a class="btn active" onclick="document.getElementById('myForm').submit();" >Pay</a>
                        </div><!-- //REGISTRATION FORM -->
                    </div><!-- //SIDEBAR -->

                    </form>
                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection