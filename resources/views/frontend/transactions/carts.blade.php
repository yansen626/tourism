@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div style="margin:3%;">
            <div class="row">
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
                                <th class="product-name"> Start Date</th>
                                <th class="product-name"> End Date</th>
                                <th class="product-price">Price</th>
                                <th class="product-remove"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                                <tr class="cart_item">
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="{{ URL::asset('storage/package_image/'.$cart->package->featured_image) }}"
                                                 data-at2x="{{ URL::asset('storage/package_image/'.$cart->package->featured_image) }}"
                                                 alt="" class="attachment-shop_thumbnail wp-post-image">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="#">{{$cart->package->name}}</a>
                                    </td>
                                    @php($startDate = \Carbon\Carbon::parse($cart->package->start_date)->format('d F Y'))
                                    @php($endDate = \Carbon\Carbon::parse($cart->package->end_date)->format('d F Y'))
                                    <td class="product-quantity">
                                        {{$startDate}}
                                    </td>
                                    <td class="product-quantity">
                                        {{$endDate}}
                                    </td>
                                    @php($priceConvert = $cart->package->price / $currencyValue)
                                    @php($priceConvert = number_format($priceConvert, 2, ",", "."))
                                    <td class="product-price"><span class="amount">{{$currencyType}} {{$priceConvert}}</span></td>

                                    <td class="product-remove"><a href="{{route('delete-cart', ['cartId'=>$cart->id])}}" title="Remove this item" class="remove"></a></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="actions">
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
                                <td colspan="6" style="padding-left: 15px;">
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

        function selectVoucher(e){
            // Get status filter value
            var voucher = $('#coupon_code').val();
            var currency = $('#currency').val();

            var url = "/cart?voucher=" + voucher + "&currency=" + currency;

            window.location = url;
        }
    </script>
@endsection