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
                                        <a class="btn btn-default" href="{{ route('travelmate.packages.trip.index', ['package' => $trip->package_id]) }}">
                                            <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                    <h4 style="float: left;">EDIT TRIP</h4>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{ Form::open(['route'=>['travelmate.packages.trip.update', $trip->id],'method' => 'put','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data', 'novalidate']) }}
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

                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        <div class="form-group">
                                            <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                                {{ \Illuminate\Support\Facades\Session::get('message') }}
                                            </div>
                                        </div>
                                    @endif

                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="start_date">--}}
                                            {{--Start Date--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                            {{--<input type="text" id="start_date" name="start_date" class="form-control col-md-12" value="{{ $trip->start_date_string }}"/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="end_date">--}}
                                            {{--End Date--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                            {{--<input type="text" id="end_date" name="end_date" class="form-control col-md-12" value="{{ $trip->end_date_string }}"/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="featured">
                                            Featured Image
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::file('featured', array('id' => 'featured', 'class' => 'file-loading', 'data-image-featured-path' => asset('storage/package_trip_image/'. $trip->featured_image))) !!}
                                        </div>
                                    </div>

                                    <input type="hidden" id="featured_changed" name="featured_changed"/>

                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="cover-container">

                                                @foreach($trip->package_trip_images as $image)
                                                    <div class="cover-item" id="{{ $image->id. '_img' }}">
                                                        <div class="cover-image" style="background-image: url('{{ asset('storage/package_trip_image/'. $image->filename) }}')">
                                                            <div class="cover-btn-group">
                                                                {{--<div id="{{ $photo->id. '_btn_toggle' }}" class="btn btn-danger btn-cover-toggle" style="margin:0 auto;" onclick="makeFeatured('{{ $photo->id }}')">Make Featured</div><br/>--}}
                                                                <div id="{{ $image->id. '_btn_delete' }}" class="btn btn-danger btn-cover-delete" style="margin:0 auto;" onclick="deleteImageEdit('{{ $image->id }}')" data-disabled="false")>Delete</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="deleted_images" name="deleted_images"/>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="price">
                                            Add Images
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
                                            <textarea id="description" name="description" rows="5" placeholder="" class="form-control" style="resize: none; overflow-y: scroll;">{{ $trip->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="{{ route('travelmate.packages.trip.index', ['package' => $trip->package_id]) }}" class="btn btn-warning">CANCEL</a>
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
        .cover-container {
            width: 100%;
            white-space: nowrap;
            overflow-x: scroll;
            overflow-y: hidden;
        }
        .cover-item {
            position: relative;
            display: inline-block;
            margin: 8px 8px;
            box-shadow: 2px 2px 4px #bbb;
            border-top-right-radius: 4px;
            width: 200px;
            height: 250px;
            vertical-align: bottom;
            border-style: solid;
            text-align: center;
        }

        .cover-image{
            background: no-repeat center;
            background-size: cover;
            height: 245px;
        }

        .cover-btn-group{
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
        }
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
        var imgFeaturedPath = $("#featured").attr('data-image-featured-path');
        $("#featured").fileinput({
            initialPreview:[imgFeaturedPath],
            overwriteInitial: true,
            maxFilePreviewSize: 10240,
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            showUpload: false,
            initialPreviewAsData: true,
            dropZoneTitle: "RECOMMENDED SIZE IMAGE 700 x 500"
        });

        $("#more_images").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            showUpload: false,
            dropZoneTitle: "RECOMMENDED SIZE IMAGE 700 x 500"
        });

        $("#featured").on('fileloaded', function(event, file, previewId, index, reader){
            $("#featured_changed").val("new");
        });

        function deleteImageEdit(id){
            var deleteBtn = $("#" + id + "_btn_delete");

            var isDisabled = deleteBtn.attr('data-disabled');

            if(isDisabled === "false"){
                var hiddenVal = $("#deleted_images").val();
                if(hiddenVal == ''){
                    $("#deleted_images").val(id);
                }else {
                    $("#deleted_images").val(hiddenVal + "," + id);
                }

                $("#" + id + "_img").remove();
            }
        }
    </script>
@endsection