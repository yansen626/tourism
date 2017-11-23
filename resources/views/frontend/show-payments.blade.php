@extends('layouts.frontend-bayu')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30">
        <!-- CONTAINER -->
        <div class="container">
            <h2></h2>
        </div><!-- //CONTAINER -->
    </section>
    <!-- //BREADCRUMBS -->

    <section class="shop">

        <!-- CONTAINER -->
        <div class="container">

            <!-- ROW -->
            <div class="row">

                <!-- SIDEBAR -->
                @include('frontend.partials._sidebar')
                <!-- //SIDEBAR -->

                <!-- CONTENT -->
                <div class="col-lg-9 col-sm-9 col-sm-9 padbot20">

                    <!-- ROW -->
                    <div class="row">
                        <h2>PAYMENT STATUS</h2>
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input id="start" type="text" class="input-sm form-control" name="start" value="{{ $date_start }}"/>
                                    <span  class="input-group-addon">to</span>
                                    <input id="end" type="text" class="input-sm form-control" name="end" value="{{ $date_end }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="invoice" name="invoice" class="form-control" id="email" placeholder="invoice">
                            </div>
                            <div class="btn btn-default" onclick="orderFilter('/purchase/order')"><i class="fa fa-search"></i></div>
                        </form>

                        <table id="order-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead style="display: none;">
                            <tr>
                                <th>Test</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php( $idx = 1 )
                            @foreach($transactions as $trx)
                                <tr>
                                    <td>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading table-wrapper" data-toggle="collapse" href="#order-{{ $idx }}" style="cursor: pointer;">
                                                    <a class="invoice-link" href="{{ route('invoice-view', ['id' => $trx->id]) }}"><b>{{ $trx->invoice }}</b></a><br/>
                                                    Order Date: {{ \Carbon\Carbon::parse($trx->created_on)->format('j F Y') }} | Total: Rp {{ $trx->total_payment }}<br/>
                                                    <b>Status</b><br/>
                                                    @if($trx->status_id == 3)
                                                        Pending Payment
                                                    @elseif($trx->status_id == 4)
                                                        Payment Verification
                                                    @endif
                                                    <div class="arrow-show">
                                                        <i class="fa fa-arrow-circle-o-down">&nbsp;<b>Show</b></i>
                                                    </div>
                                                </div>
                                                <div id="order-{{ $idx }}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <b>Shipping ( {{ $trx->courier }} - {{ $trx->delivery_type }} )</b><br/>
                                                                {{ $trx->address_name }}<br/>
                                                                {{ $trx->address_detail }}<br/>
                                                                {{ $trx->subdistrict_name }}, {{ $trx->city_name }}, {{ $trx->postal_code }}<br/>
                                                                {{ $trx->province_name }}
                                                            </div>
                                                            <div class="col-lg-3 col-md-3">
                                                                <b>Weight</b><br/>
                                                                @php( $totalWeightVal = floatval($trx->total_weight / 1000) )
                                                                {{ $totalWeightVal }} Kg
                                                            </div>
                                                            <div class="col-lg-3 col-md-3">
                                                                <b>Delivery Fee</b><br/>
                                                                Rp {{ $trx->delivery_fee }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row">
                                                            <div class="cold-lg-12 col-md-12">
                                                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Weight</th>
                                                                        <th>Price</th>
                                                                        <th>Quantity</th>
                                                                        <th>Subtotal Price</th>
                                                                        <th>Note</th>
                                                                        <th>Featured Photo</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($trx->transaction_details as $detail)
                                                                        <tr>
                                                                            <td>
                                                                                @if(!empty($detail->size_option) && empty($detail->weight_option) && empty($detail->qty_option))
                                                                                    {{ $detail->name }} - {{ $detail->size_option }}
                                                                                @elseif(empty($detail->size_option) && !empty($detail->weight_option) && empty($detail->qty_option))
                                                                                    @php( $weightVal = floatval(floatval($detail->weight_option) / 1000) )
                                                                                    {{ $detail->name }} - {{ $weightVal }} Kg
                                                                                @elseif(empty($detail->size_option) && empty($detail->weight_option) && !empty($detail->qty_option))
                                                                                    {{ $detail->name }} - {{ $detail->qty_option }}
                                                                                @else
                                                                                    {{ $detail->name }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @php( $weightVal = floatval($detail->weight / 1000) )
                                                                                {{ $weightVal }} Kg
                                                                            </td>
                                                                            <td>Rp {{ $detail->price_final }}</td>
                                                                            <td class="text-center">{{ $detail->quantity }}</td>
                                                                            <td>Rp {{ $detail->subtotal_price }}</td>
                                                                            <td>
                                                                                @if(!empty($detail->buyer_note))
                                                                                    {{ $detail->buyer_note }}
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                            <td width="15%">
                                                                                <img width="100%" src="{{ asset('storage\product\\'. $detail->product->product_image()->where('featured', 1)->first()->path) }}">
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php( $idx++ )
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- //ROW -->
                </div>
                <!-- //CONTENT-->
            </div>
            <!-- //ROW -->
        </div>
        <!-- //CONTAINER -->
    </section>

@endsection