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
            @include('admin.partials._success')
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Transaction History</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-global" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Customer Name</th>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th>Cancel Note</th>
                                    <th>Order Date</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php( $idx = 1 )
                                @foreach($transactions as $trx)
                                    <tr>
                                        <td>{{ $idx }}</td>
                                        <td>{{ $trx->invoice }}</td>
                                        <td>{{ $trx->transaction_header->user->first_name }}&nbsp;{{ $trx->transaction_header->user->last_name }}</td>
                                        <td>{{ $trx->package->name }}</td>
                                        <td>Rp {{ $trx->price }}</td>
                                        <td>{{ $trx->cancel_note }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trx->transaction_header->created_at)->format('j M Y G:i:s') }}</td>
                                        <td>
                                            <a href="/admin/transaction/cancel/detail/{{ $trx->id }}" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @php( $idx++ )
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

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection
@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection