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

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $transaction->invoice }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="45%"><b>Total Price</b></td>
                                        <td width="10%"><b>:</b></td>
                                        <td width="45%">Rp {{ $transaction->total_price }}</td>
                                    </tr>

                                    @if(!empty($transaction->payment_code))
                                        <tr>
                                            <td><b>Payment Code</b></td>
                                            <td><b>:</b></td>
                                            <td>{{ $transaction->payment_code }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td><b>Delivery Fee</b></td>
                                        <td><b>:</b></td>
                                        <td>Rp {{ $transaction->delivery_fee }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Payment</b></td>
                                        <td><b>:</b></td>
                                        <td>Rp {{ $transaction->total_payment }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <ul class="list-unstyled user_data">
                                    <li><h4>{{ $transaction->user->first_name }}&nbsp;{{ $transaction->user->last_name }}</h4></li>
                                    <li>
                                        {{ $transaction->address_detail }}<br/>
                                        {{ $transaction->subdistrict_name }}, {{ $transaction->city_name }}, {{ $transaction->province_name }}, {{ $transaction->postal_code }}
                                    </li>
                                    <li>
                                        <i class="fa fa-phone user-profile-icon"></i>&nbsp;{{ $transaction->phone }}
                                    </li>
                                    <li>
                                        <i class="fa fa-truck user-profile-icon"></i>&nbsp;{{ strtoupper($transaction->courier) }} {{ $transaction->delivery_type }}
                                    </li>
                                    <li>
                                        <b>Transaction Date:</b><br/>{{ \Carbon\Carbon::parse($transaction->created_on)->format('j M Y G:i:s')}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><small>Products</small></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Weight</th>
                                                    <th>Normal Price</th>
                                                    <th>Discount</th>
                                                    <th>Flat Discount</th>
                                                    <th>Final Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal Price</th>
                                                    <th>Featured Photo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php( $idx = 1 )
                                                @foreach($transaction->transaction_details as $detail)
                                                    <tr>
                                                        <td>{{ $idx }}</td>
                                                        <td>{{ $detail->name }}</td>
                                                        <td>{{ $detail->product->category->name }}</td>
                                                        <td>{{ $detail->weight }} Gr</td>
                                                        <td>{{ $detail->price_basic }}</td>
                                                        <td>
                                                            @if(!empty($detail->discount))
                                                                {{ $detail->discount }}%
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($detail->discount_flat))
                                                                Rp{{ $detail->discount_flat }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $detail->price_final }}</td>
                                                        <td>{{ $detail->quantity }}</td>
                                                        <td>{{ $detail->subtotal_price }}</td>
                                                        <td width="15%">
                                                            <img width="100%" src="{{ asset('storage\product\\'. $detail->product->product_image()->where('featured', 1)->first()->path) }}">
                                                        </td>
                                                    </tr>
                                                    @php ( $idx++ )
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection