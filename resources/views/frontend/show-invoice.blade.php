@extends('layouts.invoice')

@section('invoice_content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <img style="width: 200px;" src="{{ URL::asset('frontend_images/lowids_text_logo.png') }}">
                <h3 class="pull-right">Invoice {{ $trx->invoice }}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{ $trx->user->first_name }}&nbsp;{{ $trx->user->last_name }}
                    </address>
                </div>
                <div class="col-xs-4">
                    <address>
                        <strong>Shipped Via:</strong><br>
                        {{ strtoupper($trx->courier) }} - {{ $trx->delivery_type }}
                    </address>
                </div>
                <div class="col-xs-4 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        {{ $trx->address_name }}<br>
                        {{ $trx->address_detail }}<br>
                        {{ $trx->city_name }}<br>
                        {{ $trx->province_name }}, {{ $trx->postal_code }}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        {{ $trx->payment_method->type }} {{ $trx->payment_method->description }}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{ \Carbon\Carbon::parse($trx->created_on)->format('j M Y') }}<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trx->transaction_details as $detail)
                                <tr>
                                    <td>{{ $detail->name }}</td>
                                    <td class="text-center">Rp {{ $detail->price_final }}</td>
                                    <td class="text-center">{{ $detail->quantity }}</td>
                                    <td class="text-right">Rp {{ $detail->subtotal_price }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">Rp {{ $trx->total_price }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">Rp {{ $trx->delivery_fee }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Admin Fee</strong></td>
                                <td class="no-line text-right">Rp {{ $trx->admin_fee }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">Rp {{ $trx->total_payment }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right" style="padding-bottom: 5%;">
        <button onclick="InvoicePrint()"id="print-preview" class="btn btn-success">Print</button>
    </div>
</div>

@endsection

<script type="text/javascript">
    function InvoicePrint() {
        window.print();
    }
</script>