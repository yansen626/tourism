@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body content-background">
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
                                                <p id="billing_first_name_field" class="form-row form-row-wide validate-required">
                                                    <input id="email" type="text" name="email" placeholder="EMAIL"/>
                                                </p>
                                                <div class="clear"></div>
                                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                    <input id="start" type="text" name="start" placeholder="START DATE" />
                                                </p>
                                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                    <input id="finish" type="text" name="finish" placeholder="FINISH DATE"/>
                                                </p>

                                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                    <input id="destination" type="text" name="destination" placeholder="DESTINATION"/>
                                                </p>
                                                <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                    <input id="participant" type="text" name="participant" placeholder="PARTICIPANT" />
                                                </p>

                                                <p class="form-row form-row-wide address-field">
                                                    <input id="budget" type="text" name="budget" placeholder="BUDGET PER PERSON" />
                                                </p>
                                                <div class="clear"></div>
                                                <p id="order_comments_field" class="form-row notes mt-20 mb-20">
                                                    <textarea id="order_comments" name="order_comments" placeholder="REQUEST" rows="2" cols="6" class="input-text"></textarea>
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


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datetimepicker.css') }}">
    <style>

        #email{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/envelope.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 459px 10px;
            background-repeat: no-repeat;
        }

        #destination{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/map-marker.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 210px 10px;
            background-repeat: no-repeat;
        }

        #participant{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/multiple-users-silhouette.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 210px 10px;
            background-repeat: no-repeat;
        }

        #budget{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/calculator.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 459px 10px;
            background-repeat: no-repeat;
        }

        #start{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/calendar-with-spring-binder-and-date-blocks.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 210px 10px;
            background-repeat: no-repeat;
        }

        #finish{
            border-radius: 30px; border-color: rgb(201,225,230); border-width: 3px;
            background-image: url('{{ URL::asset('frontend_images/calendar-with-spring-binder-and-date-blocks.png') }}');
            -webkit-background-size: 15px 15px; background-size: 15px 15px;
            background-position: 210px 10px;
            background-repeat: no-repeat;
        }

        textarea {
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 30px;
            border-color: rgb(201,225,230);
            border-width: 3px;
            resize: none;
        }

        .content-background{
            background: rgba(0, 0, 0, 0.55) url('{{ URL::asset('frontend_images/tmj-background.jpg') }}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/frontend/moment.js') }}"></script>
    <script src="{{ URL::asset('js/frontend/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#start').datetimepicker({
                format: "DD MMM Y"
            });

            $('#finish').datetimepicker({
                format: "DD MMM Y"
            });
        });
    </script>
@endsection