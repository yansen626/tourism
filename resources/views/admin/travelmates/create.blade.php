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
            @include('admin.partials._success')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>MY PACKAGES</h1>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px !important; margin-bottom: 35px;">
                        <div class="col-md-12">
                            <div class="board">
                                {!! Form::open(array('action' => 'Admin\TravelmateController@storePackage', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}


                                <div class="board-inner">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <div class="liner"></div>
                                        <li class="active">
                                            <a href="#one" data-toggle="tab" title="Tour Information">
                                              <span class="round-tabs one">
                                                      1
                                              </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#two" data-toggle="tab" title="Main Program">
                                                 <span class="round-tabs two">
                                                     2
                                                 </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#three" data-toggle="tab" title="Pricing">
                                                 <span class="round-tabs five">
                                                      3
                                                 </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    @if(count($errors))
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                </button>
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li> {{ $error }} </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="one">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row form-panel">
                                                    <div class="col-lg-4 col-md-4">
                                                        <input id='name' name="name" type='text' value="{{old('name')}}" placeholder="DESTINATION" class="form-control" style="width: 100%;"/>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 text-center">
                                                        <select id="province" name="province" class="form-control" onchange="getCity()">
                                                            <option value="-1">- Select Province -</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <select id="city" name="city" class="form-control">
                                                            <option value="-1">- Select City -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="row form-panel">
                                                    {!! Form::file('cover', array('id' => 'cover', 'class' => 'file-loading')) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="row form-panel">
                                                    <h5 class="text-center">TRAVEL CATEGORY</h5>
                                                    <div id="category_list" class="field radio_field">
                                                        @foreach($categories as $category)
                                                            <label for="category_{{ $category->id }}">
                                                                <input type="checkbox" id="category_{{ $category->id }}" name="category[]" value="{{ $category->name }}"/>
                                                                <img src="{{ URL::asset('frontend_images/categories/'.$category->name.".png") }}" style="width: 100px; height:100px">
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="row form-panel">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                                            ABOUT THE TRIP
                                                        </label>
                                                        <div class="col-lg-9 col-md-3 col-xs-12">
                                                            <textarea id="description" name="description" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{old('description')}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="row form-panel">
                                                    <div class="text-center" style="width: 100%;">
                                                        <label for="start_date">START DATE</label>
                                                    </div>
                                                    <div class="input-group date">
                                                        <input id='start_date' name="start_date" value="{{old('start_date')}}"  type="text" class="form-control">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                    {{--<div class='input-group date' data-provide="datepicker">--}}
                                                        {{--<input type='text' class="form-control" />--}}
                                                        {{--<span class="input-group-addon">--}}
                                                            {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                                        {{--</span>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="row form-panel">
                                                    <div class="text-center" style="width: 100%;">
                                                        <label for="end_date">TRIP DURATION</label>
                                                    </div>
                                                    <div class='input-group' >
                                                        <input id='duration' name="duration" value="{{old('duration')}}" type='number' class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                            <div class="col-lg-8 col-md-8 col-xs-12">
                                                <div class="row form-panel">
                                                    <div class="form-group">
                                                        <div class="text-center" style="width: 100%;">
                                                            <label for="meeting_point">MEETING POINT</label>
                                                        </div>
                                                        <textarea id="meeting_point" name="meeting_point" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{old('meeting_point')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-xs-12">
                                                <div class="row form-panel">
                                                    <div class="form-group">
                                                        <div class="text-center" style="width: 100%;">
                                                            <label for="max_capacity">MAX CAPACITY</label>
                                                            <input id='max_capacity' name="max_capacity" type='number' value="{{old('max_capacity')}}" placeholder="PERSONS" class="form-control" style="width: 100%;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row">
                                                    <div style="float: right">
                                                        <a href="#two" data-toggle="tab" class="btn btn-success btn-create" id="next_one">NEXT</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="two">
                                        <div id="trip_list" class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                            <div id="trip_1" class="col-lg-12 col-md-12" style="margin-bottom: 20px;">
                                                <div class="row form-panel">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <h3 class="text-center" style="float: left;">FIRST DESTINATION</h3>
                                                        <div style="float: right;">
                                                        <a class="btn btn-danger" style="margin-top: 20px; margin-bottom: 10px;" onclick="deleteTrip(1)"><i class="fa fa-close"></i></a>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col-lg-12 col-md-12 col-xs-12">--}}
                                                        {{--<div class="col-lg-6 col-md-6 col-xs-12">--}}
                                                            {{--<div class="row form-panel">--}}
                                                                {{--<div class="text-center" style="width: 100%;">--}}
                                                                    {{--<label for="trip_start_date_1">START DATE</label>--}}
                                                                {{--</div>--}}
                                                                {{--<div class='input-group date' >--}}
                                                                    {{--<input id='trip_start_date_1' name="trip_start_date[]" type='text' class="form-control" />--}}
                                                                    {{--<span class="input-group-addon">--}}
                                                                        {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                                                    {{--</span>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-lg-6 col-md-6 col-xs-12">--}}
                                                            {{--<div class="row form-panel">--}}
                                                                {{--<div class="text-center" style="width: 100%;">--}}
                                                                    {{--<label for="trip_end_date_1">END DATE</label>--}}
                                                                {{--</div>--}}
                                                                {{--<div class='input-group date'>--}}
                                                                    {{--<input id='trip_end_date_1' name="trip_end_date[]" type='text' class="form-control" />--}}
                                                                    {{--<span class="input-group-addon">--}}
                                                                        {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                                                    {{--</span>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="row form-panel">
                                                                {!! Form::file('trip_image[]', array('id' => 'trip_image_1', 'class' => 'file-loading')) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="row form-panel">
                                                                <textarea id="trip_description_1" name="trip_description[]" rows="5" placeholder="TRIP DESCRIPTION" class="form-control" style="resize: none; overflow-y: scroll;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top: 20px;">
                                            <a onclick="addTrip()">
                                                <i class="fa fa-plus fa-5x"></i>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row">
                                                    <div style="float: left">
                                                        <a href="#one" data-toggle="tab" class="btn btn-success btn-create" id="next_one">PREVIOUS</a>
                                                        {{--<button class="btn btn-success btn-create" id="next_one" onclick="switchTab(1);">PREVIOUS</button>--}}
                                                    </div>
                                                    <div style="float: right">
                                                        <a href="#three" data-toggle="tab" class="btn btn-success btn-create" id="next_one">NEXT</a>
                                                        {{--<button class="btn btn-success btn-create" id="next_one" onclick="switchTab(3);">NEXT</button>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="three">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover borderless" id="table_pricing">
                                                    <thead>
                                                    <th class="text-center" style="width: 15%">
                                                        Number<br/>of Travellers
                                                    </th>
                                                    <th class="text-center" style="width: 20%">
                                                        Price<br/>(IDR/PAX)
                                                    </th>
                                                    <th class="text-center" style="width: 20%">
                                                        Total<br/>(IDR)
                                                    </th>
                                                    {{--<th class="text-center" style="width: 20%">--}}
                                                        {{--You Get <br/>IDR)--}}
                                                    {{--</th>--}}
                                                    <th class="text-center" style="width: 5%"></th>
                                                    </thead>
                                                    <tbody>
                                                    <tr id="pricing_1">
                                                        <td class="text-center">
                                                            <input id="qty_1" name="qty[]" type="text" onblur="getTotal(1);" class="form-control text-center">
                                                        </td>
                                                        <td class="text-center">
                                                            <input id="price_1" name="price[]" type="text" onblur="getTotal(1);" class="form-control text-center">
                                                        </td>
                                                        <td class="text-center">
                                                            <input id="total_1" type="text" class="form-control text-center" readonly>
                                                            <input id="get_1" type="text" class="form-control text-center" readonly style="display:none;">
                                                        </td>
                                                        <td class="text-center">
                                                            <a onclick="deletePricing(1)">
                                                                <i class="fa fa-minus-square fa-2x"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top: 20px;">
                                            <a onclick="addPrice()">
                                                <i class="fa fa-plus fa-5x"></i>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row">
                                                    <div style="float: left">
                                                        <a href="#two" data-toggle="tab" class="btn btn-success btn-create" id="next_one">PREVIOUS</a>
                                                        {{--<button class="btn btn-success btn-create" id="next_one" onclick="switchTab(2);">PREVIOUS</button>--}}
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btn btn-success btn-create" id="next_one" onclick="submitPackage();">ACTIVATE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection


@section('styles')
    @parent
{{--    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datepicker.css') }}">--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/kartik-bootstrap-file-input/fileinput.min.css') }}">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);

        label > input{ /* HIDE RADIO */
            visibility: hidden; /* Makes input not-clickable */
            position: absolute; /* Remove input from document flow */
        }
        label > input + img{ /* IMAGE STYLES */
            cursor:pointer;
            border:2px solid transparent;
        }
        label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
            border:2px solid #f00;
        }

        .board ul li{
            padding-left: 0 !important;;
            margin-left: 0 !important;
        }

        /* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
        .board{
            width: 80%;
            margin: 60px auto;
            height: 500px;
            background: #fff;
            /*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
        }
        .board .nav-tabs {
            position: relative;
            /* border-bottom: 0; */
            /* width: 80%; */
            margin: 40px auto;
            margin-bottom: 0;
            box-sizing: border-box;

        }

        .board > div.board-inner{
            /*background: #fafafa url(http://subtlepatterns.com/patterns/geometry2.png);*/
            /*background-size: 30%;*/
        }

        p.narrow{
            width: 60%;
            margin: 10px auto;
        }

        .liner{
            height: 4px;
            background: #EB5532;
            position: absolute;
            width: 72%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 50%;
            z-index: 1;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            /* background-color: #ffffff; */
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tabs{
            width: 70px;
            height: 70px;
            line-height: 70px;
            display: inline-block;
            border-radius: 100px;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
            background-color: #EB5532 !important;
            color: #ffffff !important;
            border: none !important;
        }

        span.round-tabs.one{
            color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34);
        }

        li.active span.round-tabs.one{
            border: 2px solid #ddd;
            color: rgb(34, 194, 34);
        }

        span.round-tabs.two{
            color: #febe29;border: 2px solid #febe29;
        }

        li.active span.round-tabs.two{
            border: 2px solid #ddd;
            color: #febe29;
        }

        span.round-tabs.three{
            color: #3e5e9a;border: 2px solid #3e5e9a;
        }

        li.active span.round-tabs.three{
            border: 2px solid #ddd;
            color: #3e5e9a;
        }

        span.round-tabs.four{
            color: #f1685e;border: 2px solid #f1685e;
        }

        li.active span.round-tabs.four{
            background: #fff !important;
            border: 2px solid #ddd;
            color: #f1685e;
        }

        span.round-tabs.five{
            color: #999;border: 2px solid #999;
        }

        /*li.active span.round-tabs.five{*/
            /*background: #fff !important;*/
            /*border: 2px solid #ddd;*/
            /*color: #999;*/
        /*}*/

        .nav-tabs > li.active > a span.round-tabs{
            background: #fafafa;
        }
        .nav-tabs > li {
            width: 33%;
        }
        /*li.active:before {
            content: " ";
            position: absolute;
            left: 45%;
            opacity:0;
            margin: 0 auto;
            bottom: -2px;
            border: 10px solid transparent;
            border-bottom-color: #fff;
            z-index: 1;
            transition:0.2s ease-in-out;
        }*/
        li:after {
            content: " ";
            position: absolute;
            left: 45%;
            opacity:0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #ddd;
            transition:0.1s ease-in-out;

        }
        li.active:after {
            content: " ";
            position: absolute;
            left: 45%;
            opacity:1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #ddd;

        }
        .nav-tabs > li a{
            width: 70px;
            height: 70px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
        }

        .nav-tabs > li a:hover{
            background: transparent;
        }

        .tab-content{
        }
        .tab-pane{
            position: relative;
            padding-top: 50px;
        }
        .tab-content .head{
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 25px;
            text-transform: uppercase;
            padding-bottom: 10px;
        }
        .btn-outline-rounded{
            padding: 10px 40px;
            margin: 20px 0;
            border: 2px solid transparent;
            border-radius: 25px;
        }

        .btn.green{
            background-color:#5cb85c;
            /*border: 2px solid #5cb85c;*/
            color: #ffffff;
        }

        @media( max-width : 585px ){

            .board {
                width: 90%;
                height:auto !important;
            }
            span.round-tabs {
                font-size:16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }
            .tab-content .head{
                font-size:20px;
            }
            .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height:50px;
            }

            li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }

            .btn-outline-rounded {
                padding:12px 20px;
            }
        }

        .form-panel{
            border: 2px solid #EB5532;
            border-radius: 15px;
            padding: 10px;
            margin: 0;
        }

        .borderless td, .borderless th {
            border: none;
        }

        table.table{
            border: none !important;;
        }

        table.table thead tr th{
            border-right: none !important;;
            padding-left: 0px !important;;
            background-color: #ffffff; !important;
        }

        table.table tbody tr td{
            border-right: none !important;
        }

        h5{
            font-size: 14px;
        }

        #category_list input {
            float: left;
            -webkit-appearance: radio !important;
        }

        #category_list label {
            float: left;
            margin-left: 10px !important;
            font-size: 13px !important;
        }

        #category_list label + input {
            clear: both;
        }

        .btn-create{
            background-color: #EB5532 !important;
            border-color: #EB5532 !important;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    {{--<script src="{{ URL::asset('js/frontend/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ URL::asset('js/kartik-bootstrap-file-input/fileinput.min.js') }}"></script>
    <script src="{{ URL::asset('js/stringbuilder.js') }}"></script>
    <script>
        $(function(){
            $('a[title]').tooltip();
        });

        function getCity(){
            var provId = $("#province option:selected").val();

            if(provId !== '-1'){
                $.get('/admin/travelmate/packages/city?province=' + provId, function (data) {
                    if(data.success == true) {
                        $('#city').html(data.html);
                    }
                });
            }
            else{
                $('#city').html("<option value='-1'>- Select City -</option>");
            }
        }

        // FILEINPUT
        $("#cover").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            browseClass: "btn btn-primary btn-block",
            showUpload: false,
            showRemove: false,
            dropZoneEnabled: true,
            browseOnZoneClick: true,
            dropZoneTitle: "UPLOAD COVER IMAGE HERE! (RECOMMENDED SIZE IMAGE 770 x 290)",
            uploadExtraData:{'_token':'{{ csrf_token() }}'}
        });

        $("#trip_image_1").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            browseClass: "btn btn-primary btn-block",
            showUpload: false,
            showRemove: false,
            dropZoneEnabled: true,
            browseOnZoneClick: true,
            dropZoneTitle: "UPLOAD TRIP IMAGE HERE!",
            uploadExtraData:{'_token':'{{ csrf_token() }}'}
        });

        // DATE PICKER
        $('#start_date').datepicker({
            format: 'dd M yyyy',
            multidate: true,
            multidateSeparator: ", "
        });

        // $('#end_date').datetimepicker({
        //     format: "DD MMM Y"
        // });

        // DATETIMEPICKER
        // $('#trip_start_date_1').datetimepicker({
        //     format: "DD MMM Y HH:mm"
        // });
        //
        // $('#trip_end_date_1').datetimepicker({
        //     format: "DD MMM Y HH:mm"
        // });

        function switchTab(tabNumber){
            if(tabNumber === 1){
                $('.nav-tabs a[href="#one"]').tab('show')
            }
            else if(tabNumber === 2){
                $('.nav-tabs a[href="#two"]').tab('show')
            }
            else if(tabNumber === 3){
                $('.nav-tabs a[href="#three"]').tab('show')
            }
        }

        var tripIdx = 2;
        function addTrip(){
            var sbAdd = new stringbuilder();
            sbAdd.append("<div id='trip_" + tripIdx + "' class='col-lg-12 col-md-12' style='margin-bottom: 20px;'>");
            sbAdd.append("<div class='row form-panel'>");
            sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12'>");
            sbAdd.append("<h3 class='text-center' style='float: left;'>NEXT DESTINATION </h3>");
            sbAdd.append("<div style='float: right;'>");
            sbAdd.append("<button class='btn btn-danger' style='margin-top: 20px; margin-bottom: 10px;' onclick='deleteTrip(" + tripIdx + ")'><i class='fa fa-close'></i></button>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            // sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12'>");
            // sbAdd.append("<div class='col-lg-6 col-md-6 col-xs-12'>");
            // sbAdd.append("<div class='row form-panel'>");
            // sbAdd.append("<div class='text-center' style='width: 100%;'>");
            // sbAdd.append("<label for='trip_start_date_1'>START DATE</label>");
            // sbAdd.append("</div>");
            // sbAdd.append("<div class='input-group date' >");
            // sbAdd.append("<input id='trip_start_date_" + tripIdx + "' name='trip_start_date[]' type='text' class='form-control' />");
            // sbAdd.append("<span class='input-group-addon'>");
            // sbAdd.append("<span class='glyphicon glyphicon-calendar'></span>");
            // sbAdd.append("</span>");
            // sbAdd.append("</div>");
            // sbAdd.append("</div>");
            // sbAdd.append("</div>");
            // sbAdd.append("<div class='col-lg-6 col-md-6 col-xs-12'>");
            // sbAdd.append("<div class='row form-panel'>");
            // sbAdd.append("<div class='text-center' style='width: 100%;'>");
            // sbAdd.append("<label for='trip_end_date_" + tripIdx + "'>END DATE</label>");
            // sbAdd.append("</div>");
            // sbAdd.append("<div class='input-group date'>");
            // sbAdd.append("<input id='trip_end_date_" + tripIdx + "' name='trip_end_date[]' type='text' class='form-control' />");
            // sbAdd.append("<span class='input-group-addon'>");
            // sbAdd.append("<span class='glyphicon glyphicon-calendar'></span>");
            // sbAdd.append( "</span>");
            // sbAdd.append("</div>");
            // sbAdd.append("</div>");
            // sbAdd.append("</div>");
            // sbAdd.append("</div>");
            sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12' style='margin-top: 20px;'>");
            sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12'>");
            sbAdd.append("<div class='row form-panel'>");
            sbAdd.append("<input id='trip_image_" + tripIdx + "' class='file-loading' name='trip_image[]' type='file'>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12' style='margin-top: 20px;'>");
            sbAdd.append("<div class='col-lg-12 col-md-12 col-xs-12'>");
            sbAdd.append("<div class='row form-panel'>");
            sbAdd.append("<textarea id='trip_description_" + tripIdx + "' name='trip_description[]' rows='5' placeholder='TRIP DESCRIPTION' class='form-control' style='resize: none; overflow-y: scroll;'></textarea>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");
            sbAdd.append("</div>");

            $('#trip_list').append(sbAdd.toString());

            // DYNAMIC FILEINPUT
            $('#trip_image_' + tripIdx).fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                browseClass: "btn btn-primary btn-block",
                showUpload: false,
                showRemove: false,
                dropZoneEnabled: true,
                browseOnZoneClick: true,
                dropZoneTitle: "UPLOAD TRIP IMAGE HERE!",
                uploadExtraData:{'_token':'{{ csrf_token() }}'}
            });

            // DYNAMIC DATETIMEPICKER
            // $('#trip_start_date_' + tripIdx).datetimepicker({
            //     format: "DD MMM Y HH:mm"
            // });
            //
            // $('#trip_end_date_' + tripIdx).datetimepicker({
            //     format: "DD MMM Y HH:mm"
            // });

            tripIdx++;
        }

        function deleteTrip(idx){
            $('#trip_' + idx).remove();
            // tripIdx--;
        }

        // TAB PRICINGS
        function getTotal(idx){
            var qty = parseInt($('#qty_' + idx).val());
            var price = parseInt($('#price_' + idx).val());

            if(qty !== null && qty > 0 && price !== null && price > 0){
                var total = qty * price;
                $('#total_' + idx).val(total);

                var get = total - ((10/100) * total);
                $('#get_' + idx).val(get);
            }
        }

        var pricingIdx = 2;
        function addPrice(){

            var sbAddPrice = new stringbuilder();
            sbAddPrice.append("<tr id='pricing_" + pricingIdx + "'>");
            sbAddPrice.append("<td class='text-center'>");
            sbAddPrice.append("<input id='qty_" + pricingIdx + "' name='qty[]' type='text' onblur='getTotal(" + pricingIdx + ");' class='form-control text-center'>");
            sbAddPrice.append("</td>");
            sbAddPrice.append("<td class='text-center'>");
            sbAddPrice.append("<input id='price_" + pricingIdx + "' name='price[]' type='text' onblur='getTotal(" + pricingIdx + ");' class='form-control text-center'>");
            sbAddPrice.append("</td>");
            sbAddPrice.append("<td class='text-center'>");
            sbAddPrice.append("<input id='total_" + pricingIdx + "' type='text' class='form-control text-center' readonly>");
            sbAddPrice.append("</td>");
            // sbAddPrice.append("<td class='text-center'>");
            // sbAddPrice.append("<input id='get_" + pricingIdx + "' type='text' class='form-control text-center' readonly style='display:none;'>");
            // sbAddPrice.append("</td>");
            sbAddPrice.append("<td class='text-center'>");
            sbAddPrice.append("<a onclick='deletePricing(" + pricingIdx + ")'");
            sbAddPrice.append("<i class='fa fa-minus-square fa-2x'></i>");
            sbAddPrice.append("</a>");
            sbAddPrice.append("</td>");
            sbAddPrice.append("</tr>");

            $('#table_pricing').append(sbAddPrice.toString());

            pricingIdx++;
        }

        function deletePricing(idx){
            // Validate table rows count
            var rows = document.getElementById('table_pricing').getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            // alert(rows);
            if(rows !== 1){
                $('#pricing_' + idx).remove();
                pricingIdx--;
            }
        }

    </script>
@endsection