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
                        <div class="col-md-12 mb-md-70 form-horizontal form-label-left">
                                <h4>TRAVEL DIARY</h4>
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="col-md-12">
                                    <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-round"></i>{{ \Illuminate\Support\Facades\Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            @foreach($diaries as $diary)
                                <div id="trip_1" class="col-lg-12 col-md-12" style="margin-bottom: 20px;">
                                    <hr>
                                    <div class="pull-right mt-10">
                                        <a href="{{ route('traveller.profile.diary.edit', ['id'=>$diary->id]) }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                            EDIT
                                        </a>
                                    </div>
                                    @if(!empty($diary->youtube_link) && empty($diary->image_link))
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="youtube">
                                                Youtube Link
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <iframe width="450" height="315" src="{{$diary->youtube_link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="youtube">
                                                Image
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img src="{{ URL::asset('storage/traveller_diary/'.$diary->image_link) }}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">
                                            Description
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {{ $diary->description ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-xs-12 text-center" style="margin-top: 20px;">
                                        <a href="{{route('traveller.profile.diary.add')}}">
                                            <i class="fa fa-plus fa-5x"></i>
                                        </a>
                                    </div>
                                </div>
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