@extends('layouts.frontend_2')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title" style="text-align: center;">REGISTER</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >
                        @if($errors->count() > 0)
                            <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br/>
                                @endforeach
                            </div>
                        @endif

                        <form id="registerform" class="form-horizontal" role="form" method="POST" action="{{ route('submit-register') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">
                                    Email
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="email" type="text" class="form-control col-md-7 col-xs-12"
                                           name="email" value="{{ old('email') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="phone">
                                    Phone
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="phone" type="text" class="form-control col-md-7 col-xs-12"
                                           name="phone" value="{{ old('phone') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first_name">
                                    First Name
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="first_name" type="text" class="form-control col-md-7 col-xs-12"
                                           name="first_name" value="{{ old('first_name') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last_name">
                                    Last Name
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="last_name" type="text" class="form-control col-md-7 col-xs-12"
                                           name="last_name" value="{{ old('last_name') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">
                                    Password
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="password" type="password" class="form-control col-md-7 col-xs-12"
                                           name="password"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="password_confirmation">
                                    Confirm Password
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="password_confirmation" type="password" class="form-control col-md-7 col-xs-12"
                                           name="password_confirmation"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="sex">
                                    Sex
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select id="sex" name="sex" class="form-control">
                                        <option value="male" {{ old('sex') == 'male' ? "selected":"" }}>Male</option>
                                        <option value="female" {{ old('sex') == 'female' ? "selected":"" }}>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="dob">
                                    Date of Birth
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="dob" type="text" name="dob" value="{{ old('dob') }}" class="form-control col-md-7 col-xs-12"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nationality">
                                    Nationality
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="nationality" type="text" class="form-control col-md-7 col-xs-12"
                                           name="nationality" value="{{ old('nationality') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="id_card">
                                    ID Card No
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="id_card" type="text" class="form-control col-md-7 col-xs-12"
                                           name="id_card" value="{{ old('id_card') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="passport_no">
                                    Passport No
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="passport_no" type="text" class="form-control col-md-7 col-xs-12"
                                           name="passport_no" value="{{ old('passport_no') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="current_location">
                                    Current Location
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="current_location" type="text" class="form-control col-md-7 col-xs-12"
                                           name="current_location" value="{{ old('current_location') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="speaking_language">
                                    Speaking Language
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="speaking_language" type="text" class="form-control col-md-7 col-xs-12"
                                           name="speaking_language" value="{{ old('speaking_language') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="travel_interest">
                                    Travel Interest
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="travel_interest" type="text" class="form-control col-md-7 col-xs-12"
                                           name="travel_interest" value="{{ old('travel_interest') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="about_me">
                                    About Me
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea id="about_me" name="about_me" rows="5" class="form-control col-md-7 col-xs-12" style="resize: vertical">
                                        {{ old('about_me') }}
                                    </textarea>
                                </div>
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls text-center">
                                    <input type="submit" id="btn-login" class="btn btn-success" value="Register">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ URL::asset('css/frontend/bootstrap-datetimepicker.css') }}">
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/frontend/moment.js') }}"></script>
    <script src="{{ URL::asset('js/frontend/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#dob').datetimepicker({
                format: "DD MMM Y"
            });
        });
    </script>
@endsection