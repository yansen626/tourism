@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30"></section>
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
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Total Payment</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $trx)
                                    <tr>
                                        <td>{{ $trx->invoice }}</td>
                                        <td>Rp {{ $trx->total_payment }}</td>
                                        <td>{{ $trx->payment_method->type }} {{ $trx->payment_method->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trx->created_on)->format('j M Y') }}</td>
                                        <td>
                                            <a href="/admin/transaction/detail/{{ $trx->id }}" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
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