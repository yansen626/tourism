@extends('layouts.admin')

@section('dashboard')

    <!-- sidebar -->
    @include('admin.partials._sidebar')
    <!-- sidebar -->

    <!-- top navigation -->
    @include('admin.partials._navigation')
    <!-- /top navigation -->

    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Jumlah Traveller</span>
                <div class="count">{{ $customerTotal }}</div>
            </div>
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Jumlah Travelmate</span>--}}
                {{--<div class="count">{{ $travelmateTotal }}</div>--}}
            {{--</div>--}}
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Jumlah Tailor Made</span>
                <div class="count">{{ $tmjTotal }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-money"></i> Transaksi Sukses</span>
                <div class="count">{{ $trxTotal }}</div>
            </div>
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-dollar"></i> Total Incomes</span>--}}
                {{--<div class="count green">25 Millions</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Females</span>--}}
                {{--<div class="count">4,567</div>--}}
                {{--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Collections</span>--}}
                {{--<div class="count">2,315</div>--}}
                {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Connections</span>--}}
                {{--<div class="count">7,325</div>--}}
                {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
            {{--</div>--}}
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>
                                Selamat Datang,
                                {{ \Illuminate\Support\Facades\Auth::guard('user_admins')->user()->first_name }}
                                {{ \Illuminate\Support\Facades\Auth::guard('user_admins')->user()->last_name }}
                            </h3>
                        </div>
                        {{--<div class="col-md-6">--}}
                            {{--<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
                                {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
                                {{--<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        @if($newOrderTotal == 0 && $onGoingPaymentTotal == 0)
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Hi!</strong> Tidak ada notifikasi
                            </div>
                        @endif

                        @if($newOrderTotal > 0)
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Ada {{ $newOrderTotal }} pemesanan baru, silahkan cek di <a style="color: dodgerblue;" href="{{ route('new-order-list') }}"><strong>halaman ini</strong></a>
                            </div>
                        @endif

                        @if($manualPaymentTotal > 0)
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Ada {{ $manualPaymentTotal }} konfirmasi transfer bank customer, silahkan cek di <a style="color: orange;" href="{{ route('manual-transfer-payment-list') }}"><strong>halaman ini</strong></a>
                            </div>
                        @endif

                        {{--@if($onGoingPaymentTotal > 0)--}}
                            {{--<div class="alert alert-info alert-dismissible fade in" role="alert">--}}
                                {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>--}}
                                {{--</button>--}}
                                {{--Ada {{ $onGoingPaymentTotal }} status pembayaran baru, silahkan cek di <a style="color: orange;" href="{{ route('payment-list') }}"><strong>halaman ini</strong></a>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        @if($challengedCcTotal > 0)
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Ada {{ $challengedCcTotal }} pembayaran kartu kredit dalam status challenge, silahkan cek dan konfirmasi di <a style="color: orange;" href="account.midtrans.com"><strong>panel admin Midtrans</strong></a>
                            </div>
                        @endif

                        @if($deliveryReqTotal > 0)
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Ada {{ $deliveryReqTotal }} permintaan pengiriman barang, silahkan konfirmasi nomor resi pengiriman <a style="color: dodgerblue;" href="{{ route('delivery-list') }}"><strong>di halaman ini</strong></a>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <br />
    </div>

@endsection