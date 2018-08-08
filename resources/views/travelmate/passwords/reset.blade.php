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
                        <h5 style="color: lawngreen;"> {{ session('status') }} </h5>
                    @endif

                    @if($errors->count() > 0)
                        <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                            @foreach($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif

                    <div style="padding-top:30px" class="panel-body" >
                        <form id="loginform" class="form-horizontal" method="POST" action="{{ url('travelmate/password/reset') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 10px;">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Enter Your Email!" required>
                            </div>
                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 10px;">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 10px;">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection