@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
        <div style="margin-top:3%;">
            <div class="row">
                @include('frontend.traveler.partials._left-side')
                <div class="col-md-7">
                    <div class="">
                        <div class="col-md-12 mb-md-70">
                            {{ Form::open(['route'=>['traveller.profile.diary.submit', $user->id],'method' => 'post','id' => 'general-form','class'=>'form-horizontal form-label-left', 'enctype'=>'multipart/form-data']) }}
                            {{ csrf_field()}}

                                @if($errors->count() > 0)
                                    <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        @foreach($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                    </div>
                                @endif

                                <h4>TRAVEL DIARY</h4>

                            <div id="trip_1" class="col-lg-12 col-md-12" style="margin-bottom: 20px;">

                                <div class="btn-group" data-toggle="buttons" style="margin-bottom:2%;">
                                    @php($class = "")
                                    @php($checked = "")
                                    @if(old('identity') === 'YOUTUBE' || old('identity') === null)
                                        @php($class = "active")
                                        @php($checked = "checked")
                                    @endif
                                    <label class="btn btn-default form-check-label {{$class}}">
                                        <input class="form-check-input" id="id-youtube" name="identity" value="youtube" type="radio" {{$checked}}> Youtube
                                    </label>

                                    <label class="btn btn-default form-check-label {{ old('identity') === 'IMAGE' ? 'active' : '' }}">
                                        <input class="form-check-input" id="id-image" name="identity" value="image" type="radio" {{ old('identity') === 'IMAGE' ? 'checked' : '' }}> Image
                                    </label>
                                </div>
                                <div @if(old('identity') === 'IMAGE') style="display: none;" @endif class="form-group" id="form-youtube">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="youtube-value">
                                        Youtube Link
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="youtube" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('youtube')) parsley-error @endif"
                                               name="youtube" value="{{old('youtube')}}">
                                    </div>
                                </div>
                                <div @if(old('identity') === 'YOUTUBE' || old('identity') === null) style="display: none;" @endif class="form-group" id="form-image">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="image-value">
                                        Image
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::file('image', array('id' => 'image', 'class' => 'file-loading')) !!}
                                    </div>
                                </div>


                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="youtube">--}}
                                        {{--Youtube Link--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label col-md-2 col-sm-2 col-xs-12">Image</label>--}}
                                    {{--<div class="col-md-8 col-sm-8 col-xs-12">--}}
                                        {{--@if(empty($diaries->image_link))--}}
                                            {{--{!! Form::file('image', array('id' => 'image', 'class' => 'file-loading')) !!}--}}
                                        {{--@else--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">
                                        Description
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea rows="8" id="description" name="description" class="form-control col-md-7 col-xs-12">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a class="btn btn-danger" href="{{ route('traveller.profile.diary') }}">CANCEL</a>
                                        <button type="submit" class="btn btn-success">ADD</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
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
        $("#id-youtube").change(function(){
            $("#form-image").hide(300);
            $("#form-youtube").show(300);
        });

        $("#id-image").change(function(){
            $("#form-youtube").hide(300);
            $("#form-image").show(300);
        });

        // File Input
        var imgFeaturedPath = $("#image").attr('data-image-path');
        if(imgFeaturedPath !== ''){
            $("#image").fileinput({
                initialPreview:[imgFeaturedPath],
                maxFilePreviewSize: 10240,
                showUpload: false,
                overwriteInitial: true,
                // initialPreviewAsData: true,
                allowedFileExtensions: ["jpg", "jpeg", "png"]
            });
        }
    </script>
@endsection