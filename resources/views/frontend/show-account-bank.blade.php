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
                        <div class="col-lg-12 col-md-12 padbot60">
                            <div class="checkout_delivery clearfix">
                                {{--<p class="checkout_title">AKUN BANK TRANSFER</p>--}}
                                <div class="col-lg-3 col-md-3"></div>
                                <div class="col-lg-6 col-md-6 col-xs-12"style="font-size: 14px; text-align: center;">
                                    <p>
                                        Silahkan transfer ke rekening bank berikut ini
                                    </p>
                                    <p style="font-weight: bold;">
                                        BCA a.n. Lo Widjaya <br>
                                        605 030 5811
                                        <br/><br/>
                                        Mandiri a.n. Lo Widjaya <br>
                                        12400 0745 1918
                                    </p>
                                    <br/>
                                    <a href="{{ route('checkout-bank', ['invoice' => $data]) }}" class="btn btn-primary" >KONFIRMASI TRANSFER</a>
                                </div>
                                <div class="col-lg-3 col-md-3"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection