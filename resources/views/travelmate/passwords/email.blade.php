@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">
        <!-- CONTAINER -->
        <div class="container">
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Reset Password Travelmate</div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="padding-top:30px" class="panel-body" >
                        <form id="loginform" class="form-horizontal" method="POST" action="{{ url('travelmate/password/email') }}">
                            {{ csrf_field() }}

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email!" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <br/>
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls text-center">
                                    <input type="submit" id="btn-login" class="btn btn-success" value="Send Password Reset Link">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection