@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                @include('frontend.traveler.partials._left-side')
                <div class="col-md-7">
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-md-12">
                            <div id="custom-search-input">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control input-lg" placeholder="SEARCH" />
                                    <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @if($flag == 1)
                            <div class="col-md-6">
                                <h1>MY BOOKING</h1>
                            </div>
                            <div class="col-md-6">
                                <div style="float: right;">
                                    <form class="form-inline" style="margin-top:30px;">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <select id="filter-travel" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                <option value="{{ route('traveller.transactions', ['flag' => 1]) }}" {{$flag == 1 ? 'selected':''}}>ALL ({{$allCount}})</option>
                                                <option value="{{ route('traveller.transactions', ['flag' => 4]) }}" {{$flag == 4 ? 'selected':''}}>FINISHED ({{$finishedCount}})</option>
                                                <option value="{{ route('traveller.transactions', ['flag' => 5]) }}" {{$flag == 5 ? 'selected':''}}>CANCELED ({{$canceledCount}})</option>
                                                <option value="{{ route('traveller.transactions', ['flag' => 2]) }}" {{$flag == 2 ? 'selected':''}}>UPCOMING ({{$upcomingCount}})</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @elseif($flag == 2)
                            <div class="col-md-6">
                                <h1>UPCOMING</h1>
                            </div>

                        @else
                            <div class="col-md-6">
                                <h1>HISTORY</h1>
                            </div>
                            <div class="col-md-6">
                                <div style="float: right;">
                                    <form class="form-inline" style="margin-top:30px;">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <select id="filter-travel" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                <option value="{{ route('traveller.transactions', ['flag' => 4]) }}" {{$flag == 4 ? 'selected':''}}>FINISHED ({{$finishedCount}})</option>
                                                <option value="{{ route('traveller.transactions', ['flag' => 5]) }}" {{$flag == 5 ? 'selected':''}}>CANCELED ({{$canceledCount}})</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="row">
                        @if($transactions->count() == 0)
                            <div class="col-md-12">
                                <h2>No Package</h2>
                            </div>
                        @else
                            @foreach($transactions as $detailCollection)
                            <div class="col-md-12">
                                <div class="recom-item border">
                                    <div class="recom-media">
                                        <a href="{{route('transaction.detail', ['id'=>$detailCollection->id])}}">
                                            <div class="pic">
                                                <img src="{{ URL::asset('storage/package_image/'.$detailCollection->package->featured_image) }}"
                                                     data-at2x="{{ URL::asset('storage/package_image/'.$detailCollection->package->featured_image) }}"
                                                     style="width: auto;height: 245px;" alt>
                                            </div>
                                        </a>
                                        <div class="location">
                                            <a href="{{route('travelmate.profile.showid', ['id'=>$detailCollection->package->travelmate_id])}}">
                                                <i class="flaticon-suntour-adult"></i> {{$detailCollection->package->travelmate->first_name}} {{$detailCollection->package->travelmate->last_name}}
                                            </a>
                                            <br>
                                            @php($star = "stars-".$detailCollection->package->travelmate->rating)
                                            <div class="stars {{$star}}"></div>
                                            <br>
                                            <i class="flaticon-suntour-map"></i> {{$detailCollection->package->province->name}}
                                        </div>
                                    </div>
                                    <!-- Recomended Content-->
                                    <div class="recom-item-body"><a href="#">
                                            <h6 class="blog-title">{{$detailCollection->package->name}}</h6></a>
                                        <div class="recom-price">Rp {{$detailCollection->package->price}}</div>
                                        <p class="mb-30">{{$detailCollection->package->description}}</p>
                                        <a href="{{route('transaction.detail', ['id'=>$detailCollection->id])}}" class="recom-button">Read more</a>
                                        <button class="cws-button small alt">{{$detailCollection->status->description}}</button>
                                        {{--<a href="{{route('cart-list')}}" class="cws-button small alt">Add to cart</a>--}}
                                        {{--<div class="action font-2">20%</div>--}}
                                    </div>
                                    <!-- Recomended Image-->
                                </div>
                            </div>
                            @endforeach
                        @endif




                        {{--<div class="col-md-12">--}}
                            {{--<table class="table dt-responsive nowrap" cellspacing="0" width="100%" id="travel-table">--}}
                                {{--<thead style="display: none;">--}}
                                {{--<tr>--}}
                                    {{--<th class="text-center">TEST</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--<tr class="traveller-transactions" style="background: url('{{ URL::asset('storage/package_image/top-slider-1.jpg') }}') no-repeat;">--}}
                                    {{--<td class="traveller-td">--}}
                                        {{--<div class="col-md-6 text-left">--}}
                                            {{--LAMPUNG <br>December 12--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-6 text-right">--}}
                                            {{--<a class="cws-button cws-button-custom mb-20">FINISHED</a>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr class="traveller-transactions" style="background: url('{{ URL::asset('storage/package_image/top-slider-2.jpg') }}') no-repeat;">--}}
                                    {{--<td class="traveller-td">--}}
                                        {{--<div class="col-md-6 text-left">--}}
                                            {{--PULAU DERAWAN <br>November 04--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-6 text-right">--}}
                                            {{--<a class="cws-button cws-button-custom mb-20">ON TRIP</a>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr class="traveller-transactions" style="background: url('{{ URL::asset('storage/package_image/top-slider-3.jpg') }}') no-repeat;">--}}
                                    {{--<td class="traveller-td">--}}
                                        {{--<div class="col-md-6 text-left">--}}
                                            {{--PULAU MACAN <br>September 03--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-6 text-right">--}}
                                            {{--<a class="cws-button cws-button-custom mb-20">FINISHED</a>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr class="traveller-transactions" style="background: url('{{ URL::asset('storage/package_image/top-slider-4.jpg') }}') no-repeat;">--}}
                                    {{--<td class="traveller-td">--}}
                                        {{--<div class="col-md-6 text-left">--}}
                                            {{--PULAU PRAMUKA <br>September 03--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-6 text-right">--}}
                                            {{--<a class="cws-button cws-button-custom mb-20">FINISHED</a>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-3">
                    @include('frontend.traveler.partials._right-side')
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->

    @include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/datatable/jquery.dataTables.min.css') }}">
    <style>
        .cws-button-custom{
            border: 2px solid white !important;
        }
        .traveller-transactions{
            width: 100%;
            height: 300px;
            background-position: center center !important;
            background-size: cover !important;
        }

        .traveller-td{
            padding-top: 35% !important;
            color:white !important;
        }

        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input input[type="text"]{
            border: 0;
            line-height: initial;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            border-left: solid 1px #ccc;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }
        #travel-table{
            border-spacing: 0 50px;
            border: none;
        }
        .travel-header{
            position: relative;
            width: 100%;
        }

        #filter-form{
            position:absolute;
            bottom:0;
            right:0;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/frontend/datatable/jquery.dataTables.min.js') }}"></script>
    <script>
        {{--$(function() {--}}
            {{--$('#travel-table').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: '{!! route('datatables.roles') !!}',--}}
                {{--columns: [--}}
                    {{--{ data: 'name', name: 'name', class: 'text-center' },--}}
                    {{--{ data: 'description', name: 'description', class: 'text-center' },--}}
                    {{--{ data: 'action', name:'action', class: 'text-center' }--}}
                {{--],--}}
                {{--language: {--}}
                    {{--url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian-Alternative.json"--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    </script>
@endsection