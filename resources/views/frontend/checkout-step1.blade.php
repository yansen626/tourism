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
                    <li class="active_step">1. Alamat</li>
                    <li>2. Pengiriman</li>
                    <li>3. Konfirmasi Pemesanan</li>
                    <li class="last">4. Pembayaran</li>

                </ul>

                <form class="checkout_form clearfix" action="javascript:void(0);" method="get">
                    @if( !empty($Addressdata))

                        <!-- ROW -->
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 padbot60 about_us_description" data-appear-top-offset='-100' data-animated='fadeInLeft'>
                                    <p>{{$Addressdata->name}}</p>
                                    <span>{{$Addressdata->detail}} <br/>
                                    Kecamatan {{$Addressdata->subdistrict_name}} <br/> Kota/Kabupaten {{$Addressdata->city_name}},
                                        <br/>Provinsi {{$Addressdata->province_name}}, {{$Addressdata->postal_code}}</span>
                                    <a class="btn btn-primary" href="{{ route('user-address-edit', ['redirect' => 'checkout']) }}" >Ubah Alamat</a>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 padbot30" data-appear-top-offset='-100' data-animated='fadeInRight'>
                                    <img class="about_img1" src="images/about_img1.jpg" alt="" />
                                </div>
                            </div><!-- //ROW -->

                            <div class="clear"></div>

                            <a class="btn btn-primary pull-right" href="{{ route ('checkout2') }}" >Lanjutkan</a>
                    @else
                        <div style="text-align: center;">
                            <h3><b>Belum Ada Alamat</b></h3>
                            <br >
                            <a class="btn btn-primary" href="{{ route ('user-address-create', ['redirect' => 'checkout']) }}" >Tambah Alamat</a>
                        </div>
                    @endif

                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection
