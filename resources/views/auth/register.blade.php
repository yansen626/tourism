@extends('layouts.frontend')

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
                                           name="email"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first_name">
                                    First Name
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="first_name" type="text" class="form-control col-md-7 col-xs-12"
                                           name="first_name"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last_name">
                                    Last Name
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="last_name" type="text" class="form-control col-md-7 col-xs-12"
                                           name="last_name"/>
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
                                    <input id="password_confirmation" type="text" class="form-control col-md-7 col-xs-12"
                                           name="password_confirmation"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="sex">
                                    Sex
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select id="sex" name="sex" class="form-control">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nationality">
                                    Nationality
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="nationality" type="text" class="form-control col-md-7 col-xs-12"
                                           name="nationality"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="dob">
                                    Date of Birth
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="dob" type="text" name="dob" class="form-control col-md-7 col-xs-12"/>
                                </div>
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls text-center">
                                    <input type="submit" id="btn-login" class="btn btn-success" value="Login">
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