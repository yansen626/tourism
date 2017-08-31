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
                <a href="shopping-bag.html" >Back shopping bag<i class="fa fa-angle-right"></i></a>
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
                    <div class="checkout_form_input country">
                        <label>Country <span class="color_red">*</span></label>
                        <select class="basic">
                            <option value="">New ZEALaND</option>
                            <option>Australia</option>
                            <option>Hungary</option>
                        </select>
                    </div>

                    <div class="checkout_form_input sity">
                        <label>Sity <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input territory">
                        <label>Province / Territory <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input last postcode">
                        <label>Postcode <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input2 adress">
                        <label>Street Adress 1 <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input2 last adress">
                        <label>Street Adress 2</label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <hr class="clear">

                    <div class="checkout_form_input first_name">
                        <label>First Name <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input last_name">
                        <label>Last name <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input phone">
                        <label>Phone <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input last E-mail">
                        <label>e-mail <span class="color_red">*</span></label>
                        <input type="text" name="name" value="" placeholder="" />
                    </div>

                    <div class="clear"></div>

                    <div class="checkout_form_note">All fields marked with (<span class="color_red">*</span>) are required</div>

                    <a class="btn active pull-right" href="checkout2.html" >Continue</a>
                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection