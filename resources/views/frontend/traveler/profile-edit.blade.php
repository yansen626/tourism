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
                    <div class="">
                        <div class="col-md-12 mb-md-70">
                            <form class="form-horizontal form-label-left">
                                <hr/>
                                <h4>ABOUT ME</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="fname">
                                        First Name
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="fname" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('code')) parsley-error @endif"
                                               name="fname" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="lname">
                                        Surname
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="lname" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('lname')) parsley-error @endif"
                                               name="lname" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="sex">
                                        Sex
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="sex" name="sex" class="form-control col-md-7 col-xs-12 @if($errors->has('sex')) parsley-error @endif">
                                            <option value="1" selected>Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="phone">
                                        Phone No.
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="phone" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('phone')) parsley-error @endif"
                                               name="phone" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nationality">
                                        Nationality
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="phone" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('phone')) parsley-error @endif"
                                               name="phone" value="" required>
                                    </div>
                                </div>
                                <hr/>
                                <h4>VERIFIED ID</h4>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nationality">
                                        Identification
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn-group" data-toggle="buttons">

                                            <label class="btn btn-default active form-check-label">
                                                <input class="form-check-input" id="id-card" name="identity" value="idcard" type="radio" checked autocomplete="off"> ID Card
                                            </label>

                                            <label class="btn btn-default form-check-label">
                                                <input class="form-check-input" id="id-passport" name="identity" value="passport" type="radio" autocomplete="off"> Passpor
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="form-idcard">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="idcard-value">
                                        ID Card (No.ID)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="idcard-value" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('idcard-value')) parsley-error @endif"
                                               name="idcard-value" value="">
                                    </div>
                                </div>
                                <div class="form-group" id="form-passport">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="passport-value">
                                        Passport
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="passport-value" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('passport-value')) parsley-error @endif"
                                               name="passport-value" value="">
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
                                               name="language" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="interest">
                                        Travel Interest
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="interest" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('interest')) parsley-error @endif"
                                               name="interest" value="">
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
                                        <a class="btn btn-danger" href="{{ route('traveller.index') }}">CANCEL</a>
                                        <button type="submit" class="btn btn-success">SAVE</button>
                                    </div>
                                </div>
                            </form>
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