@extends('layouts.frontend')

@section('body-content')
    <!-- content-->
    <div class="content-body" style="background-image:url('{{ URL::asset('frontend_images/bg.jpg') }}');">
        <div class="container page">
            <div class="row">
                <div class="col-md-6">
                    <div class="">

                        <div class="col-md-12 mb-md-70">
                            <form name="checkout" method="post" action="shop-checkout.html" enctype="multipart/form-data" class="checkout woocommerce-checkout">
                                <div id="customer_details">
                                    <div class="col-12 mb-sm-50">
                                        <div class="billing-wrapper">
                                            <h2 class="title-section mb-5"><span style="color:#35A6DC;">MAKE YOUR</span><br> OWN TRIP</h2>
                                            <div class="woocommerce-billing-fields">
                                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                    <input id="billing_first_name" type="text" name="billing_first_name" placeholder="USERNAME" value="" class="input-text">
                                                </p>
                                                <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                    <input id="billing_last_name" type="text" name="billing_last_name" placeholder="EMAIL" value="" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                                <p id="billing_company_field" class="form-row form-row-wide">
                                                    <input placeholder="Depart date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="calendar-default textbox-n">
                                                </p>
                                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                    <input id="billing_first_name" type="text" name="billing_first_name" placeholder="DESTINATION" value="" class="input-text">
                                                </p>
                                                <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                    <input id="billing_last_name" type="text" name="billing_last_name" placeholder="PARTICIPANT" value="" class="input-text">
                                                </p>
                                                <p class="form-row form-row-wide address-field">
                                                    <input id="billing_address_2" type="text" name="billing_address_2" placeholder="TYPE OF TRANSPORT" value="" class="input-text">
                                                </p>
                                                <p class="form-row form-row-wide address-field">
                                                    <input id="billing_address_2" type="text" name="billing_address_2" placeholder="BUDGET" value="" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                                <p id="order_comments_field" class="form-row notes mt-20 mb-20">
                                                    <textarea id="order_comments" name="order_comments" placeholder="REQUEST" rows="2" cols="5" class="input-text"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--<div class="search-hotels mb-40 pattern">--}}
                            {{--<div class="tours-container">--}}
                                {{--<div class="tours-box">--}}
                                    {{--<div class="">--}}
                                        {{--<div class="search-wrap col-md-6">--}}

                                            {{--<form method="post" class="form search divider-skew">--}}
                                                {{--<div class="search-wrap">--}}
                                                    {{--<input type="text" placeholder="USERNAME" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                        {{--<div class="search-wrap col-md-6">--}}
                                            {{--<form method="post" class="form search divider-skew">--}}
                                                {{--<div class="search-wrap">--}}
                                                    {{--<input type="text" placeholder="EMAIL" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                        {{--<div class="tours-calendar col-md-12">--}}
                                            {{--<input placeholder="DATE" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="calendar-default textbox-n"><i class="flaticon-suntour-calendar calendar-icon"></i>--}}
                                        {{--</div>--}}
                                        {{--<div class="search-wrap col-md-6">--}}
                                            {{--<form method="post" class="form search divider-skew">--}}
                                                {{--<div class="search-wrap">--}}
                                                    {{--<input type="text" placeholder="DESTINATION" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                        {{--<div class="selection-box col-md-6"><i class="flaticon-suntour-adult box-icon"></i>--}}
                                            {{--<select>--}}
                                                {{--<option>Participant</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                                {{--<option>4</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                        {{--<div class="selection-box col-md-12"><i class="flaticon-suntour-children box-icon"></i>--}}
                                            {{--<select>--}}
                                                {{--<option>Type Of Transport</option>--}}
                                                {{--<option>1</option>--}}
                                                {{--<option>2</option>--}}
                                                {{--<option>3</option>--}}
                                                {{--<option>4</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                        {{--<div class="search-wrap col-md-12">--}}
                                            {{--<input type="text" placeholder="BUDGET" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                        {{--</div>--}}
                                        {{--<div class="search-wrap col-md-12">--}}
                                            {{--<input type="text" placeholder="REQUEST" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-12">--}}
                                            {{--<div class="tours-search">--}}
                                                {{--<form method="post" class="form search">--}}
                                                    {{--<div class="search-wrap">--}}
                                                        {{--<input type="text" placeholder="Destination" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                                {{--<div class="button-search">Search</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-6" style="color:#ffffff;">
                    <!-- section title-->
                    <span class="title-section mt-0 mb-0" style="font-size: 60px;">HELLO</span><br>
                    <span class="title-section mt-0 mb-0" style="font-size: 40px;">THIS IS</span><br>
                    <span class="title-section mt-0 mb-0" style="font-size: 60px;">TAILOR <br> MADE</span>
                    <!-- ! section title-->
                    <div class="cws_divider with-plus short-3 mb-20 mt-10"></div>
                    <p class="mb-50">Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    <a href="#" class="cws-button alt">SUBMIT</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection