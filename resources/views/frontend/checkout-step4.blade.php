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
                <a href="{{ route('cart') }}" >Back shopping bag<i class="fa fa-angle-right"></i></a>
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
                    <li class="done_step2">2. Delivery</li>
                    <li class="done_step">3. Payment</li>
                    <li class="active_step last">4. Confirm Orded</li>
                </ul>
            </div><!-- //CHECKOUT BLOCK -->

            <!-- ROW -->
            <div class="row">
                <div class="col-lg-9 col-md-9 padbot60">
                    <div class="checkout_confirm_orded clearfix">
                        <div class="checkout_confirm_orded_bordright clearfix">
                            <div class="billing_information">
                                <p class="checkout_title margbot10">Billing information</p>

                                <div class="billing_information_content margbot40">
                                    <span>Balashova Anna</span>
                                    <span>New York Street name 55</span>
                                    <span>841 11 Bratislava</span>
                                    <span>USA</span>
                                    <span>mymail@glammy.com</span>
                                </div>

                                <p class="checkout_title margbot10">Shipping adress</p>

                                <div class="billing_information_content margbot40">
                                    <span>Balashova Anna</span>
                                    <span>New York Street name 55</span>
                                    <span>841 11 Bratislava</span>
                                    <span>USA</span>
                                    <span>mymail@glammy.com</span>
                                </div>
                            </div>

                            <div class="payment_delivery">
                                <p class="checkout_title margbot10">Payment and delivery</p>

                                <p><span>Payment:<span> PayPal</p>
                                <img src={{ URL::asset('') }}frontend_images/paypal.jpg" alt="" />

                                <p><span>Delivery:</span> FedEx Express</p>
                                <img src="{{ URL::asset('') }}frontend_images/premium_post.jpg" alt="" />
                            </div>
                        </div>

                        <div class="checkout_confirm_orded_products">
                            <p class="checkout_title">Products</p>
                            <ul class="cart-items">
                                <li class="clearfix">
                                    <img class="cart_item_product" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                    <a href="product-page.html" class="cart_item_title">EMBROIDERED BIB PEASANT TOP</a>
                                    <span class="cart_item_price">$88.00</span>
                                </li>
                                <li class="clearfix">
                                    <img class="cart_item_product" src="{{ URL::asset('frontend_images/tovar/women/2.jpg') }}" alt="" />
                                    <a href="product-page.html" class="cart_item_title">MERINO TIPPI SWEATER IN GEOMETRIC STRIPE</a>
                                    <span class="cart_item_price">$105.00</span>
                                </li>
                                <li class="clearfix">
                                    <img class="cart_item_product" src="{{ URL::asset('frontend_images/tovar/women/3.jpg') }}" alt="" />
                                    <a href="product-page.html" class="cart_item_title">COLLECTION CASHMERE GETAWAY HOODIE</a>
                                    <span class="cart_item_price">$73.00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 padbot60">

                    <!-- BAG TOTALS -->
                    <div class="sidepanel widget_bag_totals your_order_block">
                        <h3>Your Order</h3>
                        <table class="bag_total">
                            <tr class="cart-subtotal clearfix">
                                <th>Sub total</th>
                                <td>$258.00</td>
                            </tr>
                            <tr class="shipping clearfix">
                                <th>SHIPPING</th>
                                <td>Free</td>
                            </tr>
                            <tr class="total clearfix">
                                <th>Total</th>
                                <td>$528.00</td>
                            </tr>
                        </table>
                        <a class="btn active" href="javascript:void(0);" >Place Order</a>
                    </div><!-- //REGISTRATION FORM -->
                </div><!-- //SIDEBAR -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection
