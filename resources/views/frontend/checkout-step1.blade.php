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
                    <li>3. Payment</li>
                    <li class="last">4. Confirm Orded</li>
                </ul>

                <form class="checkout_form clearfix" action="javascript:void(0);" method="get">
                    @if($data != null)

                        <div class="checkout_form_input country">
                            <label>Country <span class="color_red">*</span></label>
                            <select class="basic">
                                <option value="">New ZEALaND</option>
                                <option>Australia</option>
                                <option>Hungary</option>
                            </select>
                        </div>

                        <div class="clear"></div>

                        <a class="btn active pull-right" href="{{route ('checkout2')}}" >Continue</a>
                    @else
                        <div style="text-align: center;">
                            <h3><b>Add address</b></h3>
                            <br >
                            <a class="btn active" href="{{route ('checkout2')}}" >Add Address</a>
                        </div>
                    @endif
                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection