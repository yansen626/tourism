@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin:3%;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 mb-md-70">
                    {{ Form::open(['route'=>['travelmate.packages.information.update', $package->id],'method' => 'put','class'=>'form-horizontal form-label-left']) }}
                    {{ csrf_field()}}

                    <hr/>
                    <h4>EDIT TOUR INFORMATION</h4>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="destination">
                            DESTINATION
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="destination" name="destination" class="form-control col-md-12" value="{{ $package->province->name }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="province">
                            PROVINCE
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="province" name="province" class="form-control" onchange="getCity()">
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" @if($province->id == $package->province_id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">
                            CITY
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="city" name="city" class="form-control">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" @if($city->id == $package->city_id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="start_date">
                            START DATE
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @php($startDate = \Carbon\Carbon::parse($package->start_date)->format('d F Y'))
                            <input type="text" id="start_date" name="start_date" class="form-control col-md-12" value="{{ $startDate }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="start_date">
                            END DATE
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @php($endDate = \Carbon\Carbon::parse($package->end_date)->format('d F Y'))
                            <input type="text" id="end_date" name="end_date" class="form-control col-md-12" value="{{ $endDate }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="meeting_point">
                            MEETING POINT
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="meeting_point" name="meeting_point" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{ $package->metting_point }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="max_capacity">
                            MAX CAPACITY (PERSON)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="max_capacity" name="max_capacity" class="form-control col-md-12" value="{{ $package->max_capacity }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <a href="#" class="btn btn-warning">CANCEL</a>
                            <a href="#" class="btn btn-success">SAVE</a>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!-- ! content-->


    @include('frontend.partials._modal-login')
@endsection


@section('styles')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datetimepicker.css') }}">
    <style>
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('js/frontend/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // DATE PICKER
            $('#start_date').datetimepicker({
                format: "DD MMM Y"
            });

            $('#end_date').datetimepicker({
                format: "DD MMM Y"
            });

            function getCity(){
                var provId = $("#province option:selected").val();

                if(provId !== '-1'){
                    $.get('/travelmate/packages/city?province=' + provId, function (data) {
                        if(data.success == true) {
                            $('#city').html(data.html);
                        }
                    });
                }
                else{
                    $('#city').html("<option value='-1'>- Select City -</option>");
                }
            }
        });

    </script>
@endsection