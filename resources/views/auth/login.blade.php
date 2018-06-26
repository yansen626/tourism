@extends('layouts.frontend_2')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            {{--<div class="my_account_block clearfix">--}}
                {{--<div class="col-lg-3 col-md-3"></div>--}}
                {{--<div class="col-lg-6 col-md-6 col-xs-12">--}}
                    {{--<div class="login">--}}
                        {{--<h2 style="text-align: center;">Masuk Lowids</h2>--}}

                        {{--@if($errors->count() > 0)--}}
                            {{--<div class="alert alert-danger alert-dismissable">--}}
                                {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
                                {{--@foreach($errors->all() as $error)--}}
                                    {{--{{ $error }}<br/>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('signin') }}">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<input type="text" name="email" placeholder="Email" />--}}
                            {{--<input type="password" name="password" placeholder="Kata Sandi"/>--}}
                            {{--<div class="clearfix">--}}
                                {{--<div class="pull-left"><input type="checkbox" id="categorymanufacturer1" name="remember"/><label for="categorymanufacturer1">Ingat Saya</label></div>--}}
                                {{--<div class="pull-right"><a class="forgot_pass" href="/password/reset" >Lupa Kata Sandi?</a></div>--}}
                            {{--</div>--}}
                            {{--{{ Form::hidden('redirect', '', array('id' => 'redirect', 'value' => $redirect)) }}--}}
                            {{--<div class="center"><input type="submit" value="Masuk ke Lowids"></div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-3"></div>--}}
            {{--</div>--}}

            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">SIGN IN</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
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



                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="{{ route('signin') }}">
                            {{ csrf_field() }}

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
                            </div>

                            <div style="margin-bottom: 15px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                            </div>

                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                    </label>
                                </div>
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                {{ Form::hidden('redirect', '', array('id' => 'redirect', 'value' => $redirect)) }}
                                <div class="col-sm-12 controls text-center">
                                    <input type="submit" id="btn-login" class="btn btn-success" value="Login">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account!
                                        <a href="#">
                                            Sign Up Here
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection

@section('styles')
    @parent
    <style>
        .checkbox label{
            color: inherit;
            font-size: 85%;
            font-weight: inherit;
        }

        .checkbox input[type=checkbox]{
            margin-left: -20px;
            margin-right: 10px;
            border-color: initial;

        }
    </style>
@endsection