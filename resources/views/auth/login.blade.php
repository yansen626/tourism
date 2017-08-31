@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>I'M ALREADY REGISTERED</h2>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <input type="text" name="email" onFocus="if (this.value == 'Username or email') this.value = '';" onBlur="if (this.value == '') this.value = 'Username or email';" />
                        <input class="last" type="text" name="password" value="Password" onFocus="if (this.value == 'Password') this.value = '';" onBlur="if (this.value == '') this.value = 'Password';" />
                        <div class="clearfix">
                            <div class="pull-left"><input type="checkbox" id="categorymanufacturer1" name="remember"/><label for="categorymanufacturer1">Keep me signed</label></div>
                            <div class="pull-right"><a class="forgot_pass" href="javascript:void(0);" >Forgot password?</a></div>
                        </div>
                        <div class="center"><input type="submit" value="Login"></div>
                    </form>
                </div>
            </div>

            <div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection