@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div style="margin:3%;">
            <div class="row">
                {{--<div class="col-md-offset-6 col-lg-offset-6 col-md-6 col-lg-6 text-center">--}}
                    {{--<div class="loader"></div>--}}
                {{--</div>--}}
                <!-- content-->
                <div class="col-lg-10 col-lg-offset-1 woocommerce">
                    <h2 class="title-section mb-5">
                        <span>My Cart</span>
                    </h2>
                    <span>Select Currency : </span>
                    <label class="radio-inline custom-radio">
                        <input type="radio" value="IDR" {{$currencyType == "IDR" ? 'checked':''}}
                               onchange="selectCurrency(this);" name="optradio">IDR
                    </label>
                    <label class="radio-inline custom-radio">
                        <input type="radio" value="USD" {{$currencyType == "USD" ? 'checked':''}}
                               onchange="selectCurrency(this);" name="optradio">USD
                    </label>
                    <label class="radio-inline custom-radio">
                        <input type="radio" value="RMB" {{$currencyType == "RMB" ? 'checked':''}}
                               onchange="selectCurrency(this);" name="optradio">RMB
                    </label>
                    <input type="hidden" id="currency" value="{{$currencyType}}">
                    <br>
                    <form action="#" method="post">
                        <table class="shop_table cart">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Package</th>
                                <th class="product-name"> </th>
                                <th class="product-name"> Participant</th>
                                <th class="product-name"> Start Date</th>
                                <th class="product-name"> Trip Duration</th>
                                <th class="product-price">Price</th>
                                <th class="product-price-total">Price Total</th>
                                <th class="product-remove"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                                <tr class="cart_item">
                                    @php($qtyId = "qty_".$cart->id)
                                    @php($priceId = "price_".$cart->id)
                                    @php($requestId = "request_".$cart->id)
                                    <td class="product-thumbnail">
                                        <a href="{{route('package-detail', ['id'=>$cart->package->id])}}">
                                            <img src="{{ URL::asset('storage/package_image/'.$cart->package->featured_image) }}"
                                                 data-at2x="{{ URL::asset('storage/package_image/'.$cart->package->featured_image) }}"
                                                 alt="" class="attachment-shop_thumbnail wp-post-image">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{route('package-detail', ['id'=>$cart->package->id])}}">{{$cart->package->name}}</a>
                                    </td>
                                    <td class="product-qty">
                                        <input type="number" id="{{$qtyId}}" class="input-text corner-radius-top"
                                               value="{{$cart->qty}}" onchange="updateCart({{$cart->id}})">
                                    </td>
                                    {{--@php($startDate = \Carbon\Carbon::parse($cart->package->start_date)->format('d F Y'))--}}
                                    {{--@php($endDate = \Carbon\Carbon::parse($cart->package->end_date)->format('d F Y'))--}}
                                    <td class="product-quantity">
                                        {{$cart->package->start_date}}
                                    </td>
                                    <td class="product-quantity">
                                        {{$cart->package->duration}}
                                    </td>
                                    @php($priceConvertOri = $cart->price / $currencyValue)
                                    @php($priceConvert = number_format($priceConvertOri, 2, ",", "."))
                                    @php($totalPriceConvertOri = $cart->total_price / $currencyValue)
                                    @php($totalPriceConvert = number_format($totalPriceConvertOri, 2, ",", "."))
                                    <td class="product-price">
                                        <span class="amount">{{$currencyType}} {{$priceConvert}}</span>
                                        <input type="hidden" value="{{$priceConvertOri}}" id="{{$priceId}}">
                                    </td>
                                    <td class="product-price"><span class="amount">{{$currencyType}} {{$totalPriceConvert}}</span></td>

                                    <td class="product-remove"><a href="{{route('delete-cart', ['cartId'=>$cart->id])}}" title="Remove this item" class="remove"></a></td>
                                </tr>
                                <tr class="cart_item">
                                    <td colspan="7" style="padding: 30px;">
                                        <textarea id="{{$requestId}}" rows="5" placeholder="Special Request"
                                                  class="form-control" style="resize: none; overflow-y: scroll;margin-bottom: 1%"
                                                  onfocusout="updateCart({{$cart->id}})">{{$cart->special_request}}</textarea>
                                        <div class="loader" style="display: none;"></div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7" class="actions">
                                    <div class="coupon">
                                        <label for="coupon_code">Voucher:</label>
                                        <input id="coupon_code" type="text" name="coupon_code" value="{{$voucher}}" placeholder="Voucher code" class="input-text corner-radius-top">
                                        <button onclick="selectVoucher()" type="button" name="apply_coupon" class="cws-button alt">Apply</button>
                                    </div>
                                    {{--<input type="button" name="proceed" value="Proceed to Checkout" class="cws-button">--}}
                                    <a href="{{route('transaction.result')}}" class="cws-button">Proceed to Checkout</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-left: 15px;">
                                    <p style="color: red;">{{$voucherDescription}}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row mt-60">
                        <div class="col-md-12 mb-md-60">
                            <h2 class="mb-30 mt-0">Cart Totals</h2>
                            <table class="total-table">
                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">{{$currencyType}}  {{$totalPrice}}</span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>Voucher</th>
                                    <td><span class="amount">{{$currencyType}}  {{$voucherFinal}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><span class="amount">{{$currencyType}} {{$totalPriceFinal}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ! content-->
            </div>
        </div>
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <style>
        input[type="radio"] {
            font-style: normal;
            -webkit-appearance: radio !important;
        }
        .loader {
            border: 5px solid #f3f3f3; /* Light grey */
            border-top: 5px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
            left: 50%;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>

        function selectCurrency(e){
            // Get status filter value
            var voucher = $('#coupon_code').val();
            var status = e.value;

            var url = "/cart?voucher=" + voucher + "&currency=" + status;

            window.location = url;
        }

        function updateCart(e){
            // Get status filter value
            $('.loader').show();
            var qtyId = "#qty_" + e;
            var priceId = "#price_" + e;
            var requestId = "#request_" + e;
            var newQty = $(qtyId).val();
            var request = $(requestId).val();
            var url = "/edit-cart?qty=" + newQty + "&specialRequest=" + request + "&id=" + e;

            window.location = url;
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--url: '{{route('edit-cart')}}',--}}
                {{--data: { qty: newQty, id: e, },--}}
                {{--error:function(e) {--}}
                    {{--alert("nope " + e.message);--}}
                {{--},--}}
                {{--success: function (partialViewData) {--}}
                    {{--alert("success");--}}
                {{--}--}}
            {{--});--}}

        }

        function selectVoucher(e){
            // Get status filter value
            var voucher = $('#coupon_code').val();
            var currency = $('#currency').val();

            var url = "/cart?voucher=" + voucher + "&currency=" + currency;

            window.location = url;
        }
    </script>
@endsection