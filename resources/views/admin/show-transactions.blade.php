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
                {{--<div class="title_left">--}}
                {{--<h3>Users <small>Some examples to get you started</small></h3>--}}
                {{--</div>--}}

                {{--<div class="title_right">--}}
                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                {{--<div class="input-group">--}}
                {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button class="btn btn-default" type="button">Go!</button>--}}
                {{--</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Customer List</h2>
                            {{--<ul class="nav navbar-right panel_toolbox">--}}
                            {{--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                            {{--</li>--}}
                            {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Settings 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Settings 2</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Customer Name</th>
                                    <th>Payment Method</th>
                                    <th>Delivery</th>
                                    <th>Total Price</th>
                                    <th>Delivery Fee</th>
                                    <th>Total Payment</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{ $idx = 1 }}
                                @foreach($transactions as $trx)
                                    <tr>
                                        <td>{{ $idx }}</td>
                                        <td>{{ $trx->invoice }}</td>
                                        <td>{{ $trx->user->first_name }}&nbsp;{{ $trx->user->last_name }}</td>
                                        <td>{{ $trx->payment_method->description }}</td>
                                        <td>{{ $trx->courier->description }}&nbsp;{{ $trx->delivery_type->description }}</td>
                                        <td>{{ $trx->total_price }}</td>
                                        <td>{{ $trx->delivery_fee }}</td>
                                        <td>{{ $trx->total_payment }}</td>
                                        <td>{{ $trx->status->description }}</td>
                                    </tr>
                                    {{ $idx++ }}
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

@endsection