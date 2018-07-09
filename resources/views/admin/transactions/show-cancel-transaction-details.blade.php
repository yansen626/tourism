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
                            <div class="col-md-5 col-sm-5 col-xs-12 profile_left">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="45%"><b>Total Price</b></td>
                                        <td width="10%"><b>:</b></td>
                                        <td width="45%">Rp {{ $transaction->price }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Nama Traveller </b></td>
                                        <td><b>:</b></td>
                                        <td>{{ $transaction->transaction_header->user->first_name }}&nbsp;{{ $transaction->transaction_header->user->last_name }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Nama Package</b></td>
                                        <td><b>:</b></td>
                                        <td>{{ $transaction->package->name }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Cancel Note</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{ $transaction->cancel_note }}</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <ul class="list-unstyled user_data">
                                    <li><h4>INFORMASI TRAVELLER </h4></li>

                                    <li>
                                        <b>Nama :</b><br/>{{ $transaction->transaction_header->user->first_name }}&nbsp;{{ $transaction->transaction_header->user->last_name }}
                                    </li>
                                    <li>
                                        <b>Email :</b><br/>&nbsp;{{ $transaction->transaction_header->user->email }}
                                    </li>
                                    <li>
                                        <b>Telepon :</b><br/>&nbsp;{{ $transaction->transaction_header->user->phone }}
                                    </li>
                                    <li>
                                        <b>Metode Pembayaran :</b><br/>
                                    </li>
                                    <li>
                                        <b>Tanggal Transaction :</b><br/>{{ \Carbon\Carbon::parse($transaction->transaction_header->created_at)->format('j M Y G:i:s') }}
                                    </li>
                                    <li>
                                        <b>Status:</b><br/>
                                        <b>{{$transaction->status->description}}</b>
                                    </li>
                                </ul>
                                <ul class="list-unstyled user_data">
                                    <li><h4>INFORMASI TRAVELMATE </h4></li>

                                    <li>
                                        <b>Nama :</b><br/>{{ $transaction->package->travelmate->first_name }}&nbsp;{{ $transaction->package->travelmate->last_name }}
                                    </li>
                                    <li>
                                        <b>Email :</b><br/>&nbsp;{{ $transaction->package->travelmate->email }}
                                    </li>
                                    <li>
                                        <b>Telepon :</b><br/>&nbsp;{{ $transaction->package->travelmate->phone }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/transaction/cancel/detail">
                                    {{ csrf_field() }}

                                    @if(count($errors))
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-danger alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li> {{ $error }} </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" name="id" value="{{$transaction->id}}">
                                    <div class="form-group">
                                        <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                            <label for="amount">Jumlah Pengembalian <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="amount" name="amount" class="form-control col-md-7 col-xs-12"
                                                   value="{{ old('amount') }}">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>


                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <a class="btn btn-primary" href="{{ route('transaction-cancel-list') }}"> Batal</a>
                                            <button type="submit" class="btn btn-success"> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--<div class="col-md-9 col-sm-9 col-xs-12">--}}
                                {{--<div class="x_panel">--}}
                                    {{--<div class="x_title">--}}
                                        {{--<h2><small>Products</small></h2>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                    {{--<div class="x_content">--}}
                                        {{--<table id="datatable" class="table table-striped table-bordered">--}}
                                            {{--<thead>--}}
                                                {{--<tr>--}}
                                                    {{--<th>No</th>--}}
                                                    {{--<th>Name</th>--}}
                                                    {{--<th>Note</th>--}}
                                                    {{--<th>Category</th>--}}
                                                    {{--<th>Weight</th>--}}
                                                    {{--<th>Normal Price</th>--}}
                                                    {{--<th>Discount</th>--}}
                                                    {{--<th>Flat Discount</th>--}}
                                                    {{--<th>Final Price</th>--}}
                                                    {{--<th>Quantity</th>--}}
                                                    {{--<th>Subtotal Price</th>--}}
                                                    {{--<th>Featured Photo</th>--}}
                                                {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                                {{--@php( $idx = 1 )--}}
                                                {{--@foreach($transaction->transaction_details as $detail)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>{{ $idx }}</td>--}}
                                                        {{--<td>--}}

                                                            {{--@if(!empty($detail->size_option) && empty($detail->weight_option) && empty($detail->qty_option))--}}
                                                                {{--{{ $detail->name }} - {{ $detail->size_option }}--}}
                                                            {{--@elseif(empty($detail->size_option) && !empty($detail->weight_option) && empty($detail->qty_option))--}}
                                                                {{--@php( $weightVal = floatval(floatval($detail->weight_option) / 1000) )--}}
                                                                {{--{{ $detail->name }} - {{ $weightVal }} Kg--}}
                                                            {{--@elseif(empty($detail->size_option) && empty($detail->weight_option) && !empty($detail->qty_option))--}}
                                                                {{--{{ $detail->name }} - {{ $detail->qty_option }}--}}
                                                            {{--@else--}}
                                                                {{--{{ $detail->name }}--}}
                                                            {{--@endif--}}

                                                            {{--@if(!empty($detail->note))--}}
                                                                {{--@php( $notes = explode(';', $detail->note, 2) )--}}
                                                                {{--@foreach($notes as $note)--}}
                                                                    {{--@if(!empty($note))--}}
                                                                        {{--@php( $property = explode('=', $note, 2) )--}}
                                                                        {{--<br/>--}}
                                                                        {{--{{ $property[0] }}: {{ $property[1] }}--}}
                                                                    {{--@endif--}}
                                                                {{--@endforeach--}}
                                                            {{--@endif--}}

                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--@if(!empty($detail->buyer_note))--}}
                                                                {{--{{ $detail->buyer_note }}--}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td>{{ $detail->product->category->name }}</td>--}}
                                                        {{--<td>{{ $detail->weight }} Gr</td>--}}
                                                        {{--<td>{{ $detail->price_basic }}</td>--}}
                                                        {{--<td>--}}
                                                            {{--@if(!empty($detail->discount))--}}
                                                                {{--{{ $detail->discount }}%--}}
                                                            {{--@else--}}
                                                                {{-----}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--@if(!empty($detail->discount_flat))--}}
                                                                {{--Rp{{ $detail->discount_flat }}--}}
                                                            {{--@else--}}
                                                                {{-----}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td>{{ $detail->price_final }}</td>--}}
                                                        {{--<td>{{ $detail->quantity }}</td>--}}
                                                        {{--<td>{{ $detail->subtotal_price }}</td>--}}
                                                        {{--<td width="15%">--}}
                                                            {{--<img width="100%" src="{{ asset('storage\product\\'. $detail->product->product_image()->where('featured', 1)->first()->path) }}">--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--@php ( $idx++ )--}}
                                                {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- track modal -->
    <div id="modal-track" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tracking</h4>
                </div>
                <div id="track-content" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /track modal -->


    <script>
        function trackPopUp(){
            $("#btn-track").html("Loading...");
            $("#btn-track").attr('disabled', true);
            $.get('{{ route('track', ['id' => $transaction->id]) }}', function (data) {
                $("#modal-track").modal();
                if(data.success == true) {
                    //user_jobs div defined on page
                    $('#track-content').html(data.html);
                    $("#btn-track").removeAttr('disabled');
                    $("#btn-track").html("Track");
                }
            });
        }
    </script>

@endsection