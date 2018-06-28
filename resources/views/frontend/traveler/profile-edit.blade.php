@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                @include('frontend.traveler.partials._left-side')
                <div class="col-md-7">
                    <div class="">
                        <div class="col-md-12 mb-md-70">
                            {{ Form::open(['route'=>['traveller.profile.update', $user->id],'method' => 'put','id' => 'general-form','class'=>'form-horizontal form-label-left', 'enctype'=>'multipart/form-data']) }}
                            {{ csrf_field()}}

                                @if($errors->count() > 0)
                                    <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        @foreach($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                    </div>
                                @endif

                                <hr/>
                                <h4>ABOUT ME</h4>
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea rows="8" id="about_me" name="about_me" class="form-control col-md-7 col-xs-12">{{ $user->about_me ?? '' }}</textarea>
                                    </div>
                                </div>
                                <hr/>
                                <h4>ABOUT ME</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="fname">
                                        First Name
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="fname" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('code')) parsley-error @endif"
                                               name="fname" value="{{ $user->first_name }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="lname">
                                        Surname
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="lname" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('lname')) parsley-error @endif"
                                               name="lname" value="{{ $user->last_name }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="sex">
                                        Sex
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="sex" name="sex" class="form-control col-md-7 col-xs-12 @if($errors->has('sex')) parsley-error @endif">
                                            <option value="male" {{ $user->sex === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $user->sex === 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="phone">
                                        Phone No.
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="phone" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('phone')) parsley-error @endif"
                                               name="phone" value="{{ $user->phone }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nationality">
                                        Nationality
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="nationality" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('nationality')) parsley-error @endif"
                                               name="nationality" value="{{ $user->nationality }}" required>
                                    </div>
                                </div>
                                <hr/>
                                <h4>VERIFIED ID</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="identity">
                                        Identification
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn-group" data-toggle="buttons">

                                            <label class="btn btn-default active form-check-label">
                                                <input class="form-check-input" id="id-card" name="identity" value="idcard" type="radio" {{ $identity === 'ID CARD' ? 'checked' : '' }}> ID Card
                                            </label>

                                            <label class="btn btn-default form-check-label">
                                                <input class="form-check-input" id="id-passport" name="identity" value="passport" type="radio" {{ $identity === 'PASSPORT' ? 'checked' : '' }}> Passport
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div @if($identity === 'PASSPORT' || $identity === 'none') style="display: none;" @endif class="form-group" id="form-idcard">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="idcard-value">
                                        ID Card (No.ID)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="idcard-value" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('idcard-value')) parsley-error @endif"
                                               name="idcard-value" value="{{ $user->id_card ?? '' }}">
                                    </div>
                                </div>
                                <div @if($identity === 'ID CARD' || $identity === 'none') style="display: none;" @endif class="form-group" id="form-passport">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="passport-value">
                                        Passport
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="passport-value" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('passport-value')) parsley-error @endif"
                                               name="passport-value" value="{{ $user->passport_no ?? '' }}">
                                    </div>
                                </div>
                                <hr/>
                                <h4>OTHERS</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="language">
                                        Speaking Language
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="language" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('language')) parsley-error @endif"
                                               name="language" value="{{ $user->speaking_language ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="interest">
                                        Travel Interest
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="interest" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('interest')) parsley-error @endif"
                                               name="interest" value="{{ $user->travel_interest ?? '' }}">
                                    </div>
                                </div>
                                <hr/>
                                <h4>TRAVEL DIARY</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="youtube">
                                        Youtube Link
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="youtube" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('youtube')) parsley-error @endif"
                                               name="youtube" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a class="btn btn-danger" href="{{ route('traveller.profile.show') }}">CANCEL</a>
                                        <button type="submit" class="btn btn-success">SAVE</button>
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
@endsection

@section('scripts')
    @parent
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