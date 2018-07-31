@extends('layouts.clean')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin:3%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}">
                    </div>
                    <div class="col-md-12">
                        <h4>{{$package->name}}</h4>

                    </div>

                    <div class="col-md-12">
                        <hr>
                        <h4>TOUR INFORMATION</h4>
                    </div>
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td style="width: 200px;">DESTINATION</td>
                                <td>: {{$package->name}}, {{$package->province->name}}</td>
                            </tr>
                            <tr>
                                @php($startDate = \Carbon\Carbon::parse($package->start_date)->format('d F Y'))
                                @php($endDate = \Carbon\Carbon::parse($package->end_date)->format('d F Y'))
                                <td style="width: 200px;">SCHEDULE</td>
                                <td>: {{$startDate}} - {{$endDate}}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">TRAVEL MATE</td>
                                <td>: <a href="{{ route('travelmate.profile.showid', ['id'=>$package->travelmate_id]) }}">
                                        {{$package->travelmate->first_name}} {{$package->travelmate->last_name}}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">MEETING POINT</td>
                                <td>: {{$package->meeting_point}}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">MAX CAPACITY</td>
                                <td>: {{$package->max_capacity}}&nbsp;Person(s)</td>
                            </tr>
                            {{--<tr>--}}
                                {{--<td style="width: 200px;">CATEGORY</td>--}}

                                {{--@if($package->category_id == null)--}}
                                    {{--<td>: -</td>--}}
                                {{--@else--}}
                                    {{--<td>:--}}
                                    {{--@php($categories = preg_split('@;@', $package->category_id, NULL, PREG_SPLIT_NO_EMPTY))--}}
                                    {{--@foreach($categories as $category)--}}
                                        {{--<img src="{{ URL::asset('frontend_images/categories/'.$category.".png") }}">--}}
                                    {{--@endforeach--}}
                                    {{--</td>--}}
                                {{--@endif--}}
                            {{--</tr>--}}
                        </table>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h4>PRICING</h4>
                    </div>
                    <div id="price" class="col-md-12">
                        <span>PRICE : </span>
                        <br>
                        @if($packagePrices->count() > 0)
                            @php($qty = 0)
                            @foreach($packagePrices as $packagePrice)
                                @php($qty = $qty+1)
                                @php($finalPrice = $packagePrice->price / $currencyValue)
                                @php($priceConvert = number_format($finalPrice, 2, ",", "."))
                                <span> ({{$qty}}-{{$packagePrice->quantity}} Person) {{$currencyType}} {{$priceConvert}}</span>
                                <br>
                                @php($qty = $packagePrice->quantity)
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h4>MAIN PROGRAM</h4>
                    </div>
                    <div class="col-md-12">
                        <span>PROGRAM : </span>
                        <br>
                        @if($packageTrips->count() > 0)
                            @foreach($packageTrips as $packageTrip)
                                @php($startDateTrip = \Carbon\Carbon::parse($packageTrip->start_date)->format('d F Y G:i'))
                                @php($endDateTrip = \Carbon\Carbon::parse($packageTrip->end_date)->format('d F Y G:i'))

                                <span> ({{$startDateTrip}} - {{$endDateTrip}}) Desc : {{$packageTrip->description}}</span>
                                <br>

                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->
@endsection


@section('styles')
    @parent
    <style>
        #price input {
            float: left;
            -webkit-appearance: radio !important;
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
@endsection