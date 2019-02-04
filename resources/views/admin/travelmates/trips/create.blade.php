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
                        <div class="col-md-8 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <hr/>
                                    <div style="float: left;">
                                        <a class="btn btn-default" href="{{ route('travelmate.packages.trip.index', ['package' => $packageId]) }}">
                                            <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                    <h4 style="float: left;">ADD NEW TRIP</h4>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{ Form::open(['route'=>['travelmate.packages.trip.store', $packageId],'method' => 'post','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data', 'novalidate']) }}
                                    {{ csrf_field()}}

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

                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="start_date">--}}
                                            {{--Start Date--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                            {{--<input type="text" id="start_date" name="start_date" class="form-control col-md-12" value="{{ old('start_date') }}"/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="end_date">--}}
                                            {{--End Date--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                            {{--<input type="text" id="end_date" name="end_date" class="form-control col-md-12" value="{{ old('end_date') }}"/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="featured">
                                            Featured Image
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::file('featured', array('id' => 'featured', 'class' => 'file-loading')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="price">
                                            More Images
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::file('more_images[]', array('id' => 'more_images', 'class' => 'file-loading', 'multiple')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">
                                            Description
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="description" name="description" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{old('description')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="{{ route('travelmate.packages.trip.index', ['package' => $packageId]) }}" class="btn btn-warning">CANCEL</a>
                                            <button type="submit" class="btn btn-success">SAVE</button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
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
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/kartik-bootstrap-file-input/fileinput.min.css') }}">
    <style>
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('js/frontend/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/kartik-bootstrap-file-input/fileinput.min.js') }}"></script>
    <script>
        // DATE PICKER
        $('#start_date').datetimepicker({
            format: "DD MMM Y HH:mm"
        });

        $('#end_date').datetimepicker({
            format: "DD MMM Y HH:mm"
        });

        // FILEINPUT
        $("#featured").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            showUpload: false,
            dropZoneTitle: "RECOMMENDED SIZE IMAGE 700 x 500"
        });

        $("#more_images").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            showUpload: false,
            dropZoneTitle: "RECOMMENDED SIZE IMAGE 700 x 500"
        });
    </script>
@endsection