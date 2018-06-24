@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.traveler.partials._left-side')
                </div>
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
                            <h1>MY TRAVEL</h1>
                        </div>
                        <div class="col-md-6">
                            <div style="float: right;">
                                <form class="form-inline" style="margin-top:30px;">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <select id="filter-travel" class="form-control">
                                            <option>ALL</option>
                                            <option>FINISHED</option>
                                            <option>CANCELED</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table dt-responsive nowrap" cellspacing="0" width="100%" id="travel-table">
                                <thead style="display: none;">
                                <tr>
                                    <th class="text-center">TEST</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="traveller-transactions" style="background: url('{{ URL::asset('frontend_images/top-slider-1.jpg') }}') no-repeat;">
                                    <td class="traveller-td">
                                        <div class="col-md-6 text-left">
                                            LAMPUNG <br>December 12
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="cws-button cws-button-custom mb-20">FINISHED</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="traveller-transactions" style="background: url('{{ URL::asset('frontend_images/top-slider-2.jpg') }}') no-repeat;">
                                    <td class="traveller-td">
                                        <div class="col-md-6 text-left">
                                            PULAU DERAWAN <br>November 04
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="cws-button cws-button-custom mb-20">ON TRIP</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="traveller-transactions" style="background: url('{{ URL::asset('frontend_images/top-slider-3.jpg') }}') no-repeat;">
                                    <td class="traveller-td">
                                        <div class="col-md-6 text-left">
                                            PULAU MACAN <br>September 03
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="cws-button cws-button-custom mb-20">FINISHED</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="traveller-transactions" style="background: url('{{ URL::asset('frontend_images/top-slider-4.jpg') }}') no-repeat;">
                                    <td class="traveller-td">
                                        <div class="col-md-6 text-left">
                                            PULAU PRAMUKA <br>September 03
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="cws-button cws-button-custom mb-20">FINISHED</a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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