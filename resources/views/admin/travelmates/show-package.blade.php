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
                <div class="content-body">
                    {{--<div class="container page">--}}

                    {{--<section class="cws_prlx_section">--}}
                        {{--<img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}" alt class="cws_prlx_layer">--}}
                        {{--<div class="container">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12 mb-md-60">--}}
                                    {{--&nbsp;<br>--}}
                                    {{--&nbsp;<br>--}}
                                    {{--&nbsp;<br>--}}
                                    {{--&nbsp;--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</section>--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                            <div class="package-banner" style="background-image: url('{{ URL::asset('storage/package_image/'.$package->featured_image) }}')">

                            </div>
                            </div>
                            <div class="col-md-12">
                                <h4>{{$package->name}}</h4>
                            </div>

                            <div class="col-md-12">
                                <hr>

                                <h4 style="float:left;">TOUR INFORMATION</h4>
                                <div style="float: right">
                                    <a href="{{ route('travelmate.packages.information.edit',['package' => $package->id]) }}" class="btn btn-default" style="background-color: #EB5532; color:white;">
                                        EDIT
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p>STATUS </p>
                            </div>
                            <div class="col-md-9">
                                <p>: <b>{{$package->status->description}}</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>DESTINATION </p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{$package->name}}, {{$package->province->name}}</p>
                            </div>

                            <div class="col-md-3">
                                <p>SCHEDULE</p>
                            </div>
                            <div class="col-md-9">
                                {{--@php($startDate = \Carbon\Carbon::parse($package->start_date)->format('d F Y'))--}}
                                {{--@php($endDate = \Carbon\Carbon::parse($package->end_date)->format('d F Y'))--}}
                                <p>: {{ $package->start_date. ' - '. $package->duration }} Day(s)</p>
                            </div>
                            {{--<div class="col-md-3">--}}
                                {{--<p>TRAVEL MATE</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-9">--}}
                                {{--<p style="font-size: 16px;">--}}
                                    {{--: <a href="{{ route('travelmate.profile.showid', ['id'=>$package->travelmate_id]) }}">--}}
                                        {{--{{$package->travelmate->first_name}} {{$package->travelmate->last_name}}--}}
                                    {{--</a>--}}
                                {{--</p>--}}
                            {{--</div>--}}

                            <div class="col-md-3">
                                <p>MEETING POINT </p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{$package->meeting_point}}&nbsp;</p>
                            </div>
                            <div class="col-md-3">
                                <p>MAX CAPACITY </p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{$package->max_capacity}}&nbsp;Person(s)</p>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <p>CATEGORY </p>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                @if($package->category_id == null)
                                    <p>: -</p>
                                @else
                                    @php($categories = preg_split('@;@', $package->category_id, NULL, PREG_SPLIT_NO_EMPTY))
                                    @foreach($categories as $category)
                                        <img src="{{ URL::asset('frontend_images/categories/'.$category.".png") }}" style="width: 70px;padding-bottom: 10px;">
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4 style="float: left;">PRICING</h4>
                                <div style="float: right;">
                                    <a href="{{ route('travelmate.packages.price.index', ['package' => $package->id]) }}" class="btn btn-default" style="background-color: #EB5532; color:white;">
                                        EDIT
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span>PRICE : </span>
                            </div>
                            <div class="col-md-9">

                                @if($packagePrices->count() > 0)
                                    @php($qty = 0)
                                    @foreach($packagePrices as $packagePrice)
                                        @php($qty = $qty+1)
                                        <span> ({{$qty}}-{{$packagePrice->quantity}} Person) IDR {{$packagePrice->price}}</span>
                                        <br>
                                        @php($qty = $packagePrice->quantity)
                                    @endforeach
                                @endif

                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4 style="float: left;">MAIN PROGRAM</h4>
                                <div style="float: right;">
                                    <a href="{{ route('travelmate.packages.trip.index', ['package' => $package->id]) }}" class="btn btn-default" style="background-color: #EB5532; color:white;">
                                        EDIT
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span>PROGRAM : </span>
                                <br>

                                <div class="row form-panel">
                                    @if($packageTrips->count() > 0)
                                        @foreach($packageTrips as $packageTrip)
                                            @php($startDateTrip = \Carbon\Carbon::parse($packageTrip->start_date)->format('d/m/Y G:i'))
                                            @php($endDateTrip = \Carbon\Carbon::parse($packageTrip->end_date)->format('d/m/Y G:i'))

                                            <span> ({{$startDateTrip}} - {{$endDateTrip}}) Desc : {{$packageTrip->description}}</span>
                                            <br>

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <a href="{{route('travelmate.packages.status.update', ['package' => $package->id]) }}" class="btn btn-danger">DEACTIVATE THIS PACKAGE</a>
                            </div>
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
    <style>
        .package-banner{
            width: 100%;
            height: 300px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .cws_divider, hr {
            border-bottom: 2px solid #EB5532;
        }
        .form-panel{
            overflow-y :scroll;
            height:150px;
            border: 2px solid #EB5532;
            border-radius: 15px;
            padding: 10px;
            margin: 0;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function () {
            // $('.daterangepicker.dropdown-menu.ltr.show-calendar.opensleft').show();
            // $(".daterangepicker").show();
        });

        // $(function() {
        //     $('input[name="daterange"]').daterangepicker({
        //         autoApply: true,
        //         alwaysShowCalendars: true,
        //         opens: 'left',
        //         locale: {
        //             format: 'DD/MM/YYYY'
        //         }
        //     }, function(start, end, label) {
        //         console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        //
        //
        //     });
        // });
    </script>
@endsection