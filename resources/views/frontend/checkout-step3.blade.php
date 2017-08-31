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
                    <li class="done_step">2. Delivery</li>
                    <li class="active_step">3. Payment</li>
                    <li class="last">4. Confirm Orded</li>
                </ul>

                <div class="checkout_payment clearfix">
                    <div class="payment_method padbot70">
                        <p class="checkout_title">payment Method</p>

                        <ul class="clearfix">
                            <li>
                                <input id="ridio1" type="radio" name="radio" hidden />
                                <label for="ridio1">Visa<br><img src="{{ URL::asset('frontend_images/visa.jpg') }}" alt="" /></label>
                            </li>
                            <li>
                                <input id="ridio2" type="radio" name="radio" hidden />
                                <label for="ridio2">Master Card<br><img src="{{ URL::asset('frontend_images/master_card.jpg') }}" alt="" /></label>
                            </li>
                            <li>
                                <input id="ridio3" type="radio" name="radio" hidden />
                                <label for="ridio3">PayPal<br><img src="{{ URL::asset('frontend_images/paypal.jpg') }}" alt="" /></label>
                            </li>
                            <li>
                                <input id="ridio4" type="radio" name="radio" hidden />
                                <label for="ridio4">Discover<br><img src="{{ URL::asset('frontend_images/discover.jpg') }}" alt="" /></label>
                            </li>
                            <li>
                                <input id="ridio5" type="radio" name="radio" hidden />
                                <label for="ridio5">Skrill<br><img src="{{ URL::asset('frontend_images/skrill.jpg') }}" alt="" /></label>
                            </li>
                        </ul>
                    </div>

                    <div class="credit_card_number padbot80">
                        <p class="checkout_title">Credit Card Number</p>

                        <form class="credit_card_number_form clearfix" action="javascript:void(0);" method="get">
                            <input type="text" name="card number" value="Number" onFocus="if (this.value == 'Number') this.value = '';" onBlur="if (this.value == '') this.value = 'Number';" />
                            <div class="margrightminus20">
                                <select class="basic">
                                    <option value="">MM</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                </select>
                                <select class="basic last">
                                    <option value="">YYYY</option>
                                    <option>2010</option>
                                    <option>2011</option>
                                    <option>2012</option>
                                    <option>2013</option>
                                    <option>2014</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="clear"></div>

                    <div class="checkout_delivery_note"><i class="fa fa-exclamation-circle"></i>Express delivery options are available for in-stock items only.</div>

                    <a class="btn active pull-right checkout_block_btn" href="checkout4.html" >Continue</a>
                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection