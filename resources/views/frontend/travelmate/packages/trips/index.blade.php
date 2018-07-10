@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
        <div style="margin-top:3%;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="">
                        <div class="col-md-12 mb-md-70 form-horizontal form-label-left">
                            <h4>PACKAGE TRIPS</h4>
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="col-md-12">
                                    <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-round"></i>{{ \Illuminate\Support\Facades\Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            @foreach($trips as $trip)
                                <div id="trip_1" class="col-lg-12 col-md-12" style="margin-bottom: 20px;">
                                    <hr>
                                    <div class="pull-right mt-10">
                                        <a href="{{ route('travelmate.packages.trip.edit', ['package_trip' => $trip->id]) }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                            EDIT
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            Featured Image
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <img src="{{ URL::asset('storage/package_trip_image/'. $trip->featured_image) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            Date
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control col-md-12" value="{{ $trip->start_date_string. ' - '. $trip->end_date_string }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            Description
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea rows="5" class="form-control col-md-12" readonly>{{ $trip->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <hr style="width: 80%; margin: 0 auto;"/>
                                </div>

                            @endforeach
                            {{--<div class="form-group">--}}
                                {{--<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top: 20px;">--}}
                                    {{--<a href="{{route('traveller.profile.diary.add')}}">--}}
                                        {{--<i class="fa fa-plus fa-5x"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!-- ! content-->
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/kartik-bootstrap-file-input/fileinput.min.css') }}">
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/kartik-bootstrap-file-input/fileinput.min.js') }}"></script>
    <script src="{{ URL::asset('js/stringbuilder.js') }}"></script>
    <script>
        $("#id-card").change(function(){
            $("#form-passport").hide(300);
            $("#form-idcard").show(300);
        });

        $("#id-passport").change(function(){
            $("#form-idcard").hide(300);
            $("#form-passport").show(300);
        });

    </script>
@endsection