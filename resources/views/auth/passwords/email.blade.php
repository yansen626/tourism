@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">
        <!-- CONTAINER -->
        <div class="container">
            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Reset Password</h2>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email!" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <br/>
                        <div class="center"><input type="submit" value="Send Password Reset Link"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
