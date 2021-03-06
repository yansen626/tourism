@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                @include('frontend.travelmate.partials._left-side')
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
                        <div class="col-md-6">
                            <h1>MY TRIP</h1>
                        </div>
                        <div class="col-md-6">
                            <div style="float: right;">
                                <form class="form-inline" style="margin-top:30px;">
                                    <div class="form-group">
                                        <label>Sort By:&nbsp;</label>
                                        <select id="filter-trip" class="form-control" onchange="changeStatus();">
                                            <option value="0" {{ $filter === "8" ? 'selected' : '' }}>All ({{$allCount}})</option>
                                            <option value="8" {{ $filter === "8" ? 'selected' : '' }}>FINISH ({{$finishCount}})</option>
                                            <option value="9" {{ $filter === "9" ? 'selected' : '' }}>CANCEL ({{$cancelCount}})</option>
                                            <option value="13" {{ $filter === "13" ? 'selected' : '' }}>UPCOMING ({{$upcomingCount}})</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px !important;">
                        @if($transactions->count() == 0)
                            <div class="col-md-12">
                                <h2>No Trip</h2>
                            </div>
                        @else
                        @foreach($transactions as $transaction)
                            <div class="col-md-12">
                                <div class="recom-item border">
                                    <div class="recom-media">
                                        <a href="{{route('travelmate.packages.show', ['package'=>$transaction->package->id])}}">
                                            <div class="pic">
                                                <img src="{{ URL::asset('storage/package_image/'.$transaction->package->featured_image) }}"
                                                     data-at2x="{{ URL::asset('storage/package_image/'.$transaction->package->featured_image) }}"
                                                     style="width: auto;height: 245px;" alt>
                                            </div>
                                        </a>
                                        <div class="location">
                                            <a href="{{route('travelmate.profile.showid', ['id'=>$transaction->package->travelmate_id])}}">
                                                <i class="flaticon-suntour-adult"></i> {{$transaction->package->travelmate->first_name}} {{$transaction->package->travelmate->last_name}}
                                            </a>
                                            <br>
                                            @php($star = "stars-".$transaction->package->travelmate->rating)
                                            <div class="stars {{$star}}"></div>
                                            <br>
                                            <i class="flaticon-suntour-map"></i> {{$transaction->package->province->name}}
                                        </div>
                                    </div>
                                    <!-- Recomended Content-->
                                    <div class="recom-item-body"><a href="#">
                                            <h6 class="blog-title">{{$transaction->package->name}}</h6></a>
                                        <div class="recom-price">Rp {{$transaction->package->price}}</div>
                                        <p class="mb-30">{{$transaction->package->description}}</p>
                                        <a href="{{route('travelmate.packages.show', ['package'=>$transaction->package->id])}}" class="recom-button">Read more</a>
                                        <button class="cws-button small alt">{{$transaction->status->description}}</button>
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
                                {{--@foreach($packages as $package)--}}
                                    {{--@php( $img = $package->featured_image )--}}
                                    {{--<tr class="travelmate-transactions" style="background: url('{{ URL::asset('storage/package_image/'. $img) }}') no-repeat;">--}}
                                        {{--<td class="travelmate-td">--}}
                                            {{--<div class="col-md-6 text-left">--}}
                                                {{--{{ $package->name }} <br>{{ $package->province->name }}, {{ $package->city->name }}--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6 text-right">--}}
                                                {{--<a class="cws-button cws-button-custom mb-20">{{$package->status->description}}</a>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                            {{--{{ $packages->links() }}--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-3">
                    @include('frontend.travelmate.partials._right-side', ['allPackage'=>$allPackage, 'upcomingPackage'=>$upcomingPackage])
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
        .travelmate-transactions{
            width: 100%;
            height: 300px;
            background-position: center center !important;
            background-size: cover !important;
        }

        .travelmate-td{
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
            border-spacing: 0 25px;
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
        function changeStatus(){
            // Get status filter value
            var status = $('#filter-trip').val();

            var url = "/travelmate/my-trips?status=" + status;

            window.location = url;
        }
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