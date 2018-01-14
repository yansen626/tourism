@extends('layouts.admin')

@section('dashboard')

    <!-- sidebar -->
    @include('admin.partials._sidebar')
    <!-- sidebar -->

    <!-- top navigation -->
    @include('admin.partials._navigation')
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            @include('admin.partials._success')
                            <h2>Status Pembayaran</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-payment" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Nama Transaksi</th>
                                    <th>Nama Pengirim</th>
                                    <th>Jumlah Transfer</th>
                                    <th>Yang harus Dibayar</th>
                                    <th>Tanggal Transfer</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Catatan Transfer</th>
                                    <th>Pilihan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transfers as $trans)
                                    {{--@php( $trans = $trx->transfer_confirmation()->first())--}}
                                    @php( $trx = $trans->Transaction()->first())
                                    <tr>
                                        <td><a href="{{ route('admin-invoice', ['trxId' => $trx->id]) }}">{{ $trx->invoice }}</a></td>
                                        <td>{{ $trx->user->first_name }}&nbsp;{{ $trx->user->last_name }}</td>
                                        <td>{{ $trans->sender_name ?? '-'}}</td>
                                        <td>
                                            @if(!empty($trans))
                                                Rp {{ $trans->transfer_amount }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>Rp {{ $trx->total_payment }}</td>
                                        <td>
                                            @if(!empty($trans->transfer_date))
                                                {{ \Carbon\Carbon::parse($trans->transfer_date)->format('j M Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($trx->created_on))
                                                {{ \Carbon\Carbon::parse($trx->created_on)->format('j M Y G:i:s') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($trx->note))
                                                {{ $trx->note }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/admin/transaction/detail/{{ $trx->id }}" class="btn btn-primary">Detail</a>
                                            @if(!empty($trans))
                                                <a onclick="modalPop('{{ $trans->id }}', 'transfer', '/admin/payment/confirm/')" class="btn btn-success">Konfirmasi</a>
                                            @endif
                                            <a onclick="modalPop('{{ $trx->id }}', 'cancel', '/admin/payment/cancel/')" class="btn btn-danger">Hapus</a>
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
    <!-- /page content -->

    <!-- small modal -->
    @include('admin.partials._small_modal')
    <!-- /small modal -->

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection