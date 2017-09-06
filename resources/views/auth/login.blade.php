@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Login</h2>

                    @foreach($errors->all() as $error)
                        <h5 style="color: red;"> {{ $error }} </h5>
                    @endforeach

                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <input type="text" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password"/>
                        <div class="clearfix">
                            <div class="pull-left"><input type="checkbox" id="categorymanufacturer1" name="remember"/><label for="categorymanufacturer1">Keep me signed</label></div>
                            <div class="pull-right"><a class="forgot_pass" href="/password/reset" >Forgot password?</a></div>
                        </div>
                        <div class="center"><input type="submit" value="Login"></div>
                    </form>
                </div>
            </div>

            <div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection