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
                <div style="margin:3%;">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 mb-md-70">
                            {{ Form::open(['route'=>['travelmate.packages.information.update', $package->id],'method' => 'put','class'=>'form-horizontal form-label-left']) }}
                            {{ csrf_field()}}

                            <hr/>
                            <h4>EDIT TOUR INFORMATION</h4>

                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="form-group">
                                    <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                                    </div>
                                </div>
                            @endif

                            @if($errors->count() > 0)
                                <div class="form-group">
                                    <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        @foreach($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="destination">
                                    DESTINATION
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="destination" name="destination" class="form-control col-md-12" value="{{ $package->name }}"/>
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
                                    {{--@php($startDate = \Carbon\Carbon::parse($package->start_date)->format('d F Y'))--}}
                                    <input id='start_date' name="start_date" value="{{$package->start_date}}"  type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="end_date">
                                    END DATE
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{--@php($endDate = \Carbon\Carbon::parse($package->end_date)->format('d F Y'))--}}
                                    <input id='duration' name="duration" value="{{$package->duration}}" type='number' class="form-control" />
                                    {{--<input type="text" id="end_date" name="end_date" class="form-control col-md-12" value="{{ $endDate }}"/>--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="meeting_point">
                                    MEETING POINT
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="meeting_point" name="meeting_point" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{ $package->meeting_point }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="max_capacity">
                                    MAX CAPACITY (PERSON)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="max_capacity" name="max_capacity" class="form-control col-md-12" value="{{ $package->max_capacity }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="{{ route('travelmate.packages.show', ['id' => $package->id]) }}" class="btn btn-warning">CANCEL</a>
                                    <button type="submit" class="btn btn-success">SAVE</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-2"></div>
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
    {{--<link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datetimepicker.css') }}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    {{--<script src="{{ URL::asset('js/frontend/bootstrap-datetimepicker.min.js') }}"></script>--}}
    <script>
        $(document).ready(function () {
            // DATE PICKER
            // $('#start_date').datetimepicker({
            //     format: "DD MMMM Y"
            // });
            //
            // $('#end_date').datetimepicker({
            //     format: "DD MMMM Y"
            // });
        });
        // DATE PICKER
        $('#start_date').datepicker({
            format: 'dd M yyyy',
            multidate: true,
            multidateSeparator: ", "
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

    </script>
@endsection