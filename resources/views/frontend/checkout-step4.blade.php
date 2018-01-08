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
                <a href="{{ route('cart-list') }}" >Kembali ke keranjang belanja<i class="fa fa-angle-right"></i></a>
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
                    <li class="done_step2">1. Alamat</li>
                    <li class="done_step">2. Pengiriman</li>
                    <li class="done_step">3. Konfirmasi Pemesanan</li>
                    <li class="active_step last">4. Pembayaran</li>
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
                            <p class="checkout_title">PILIH METODE PEMBAYARAN</p>
                            @if($errors->count() > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    @foreach($errors->all() as $error)
                                        <b>{{ $error }}</b>
                                    @endforeach
                                </div>
                            @endif

                            @if(!empty($ex))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        One of your products is out of stock, return to shopping cart <a class="custom-link" href="{{ route('cart-list') }}" >here</a>
                                </div>
                            @endif

                            <ul>
                                <li style="width: auto !important;">
                                    <input id="ridio1" type="radio" name="payment" hidden value="bank_transfer" onchange="handleChangePayment(this);" />
                                    <label for="ridio1"><b>Transfer Bank ke akun virtual</b></label>
                                </li>

                                <li>
                                    <input id="ridio2" type="radio" name="payment" hidden value="credit_card" onchange="handleChangePayment(this);" />
                                    <label for="ridio2"><b>Kartu Kredit</b></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 padbot60">

                        <!-- BAG TOTALS -->
                        <div class="sidepanel widget_bag_totals your_order_block">
                            <h3>Pesanan Anda</h3>
                            <table class="bag_total">
                                <tr class="cart-subtotal clearfix">
                                    <th>Sub Total</th>
                                    <td>Rp {{$totalPrice}}</td>
                                </tr>
                                <tr class="shipping clearfix">
                                    <th>Ongkos Kirim</th>
                                    <td>Rp {{$shipping}}</td>
                                </tr>
                                <tr class="shipping clearfix">
                                    <input type="hidden" id="selected-fee" name="selected-fee" value="0">
                                    <th>Biaya Administrasi</th>
                                    <td id="admin-fee">Rp 0</td>
                                </tr>
                                <tr class="total clearfix">
                                    <input type="hidden" id="grand-total-value" value="{{$grandTotal}}">
                                    <th>Total</th>
                                    <td id="grand-total-price">Rp {{$grandTotal}}</td>
                                </tr>
                                {{--<tr class="shipping clearfix">--}}
                                    {{--<th style="color:red">Price includes admin fee</th>--}}
                                {{--</tr>--}}
                            </table>
                            <a class="btn btn-primary" onclick="document.getElementById('myForm').submit();" >BAYAR SEKARANG</a>
                        </div><!-- //REGISTRATION FORM -->
                    </div><!-- //SIDEBAR -->

                    </form>
                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection