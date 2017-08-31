@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Create New User</h2>
                    <form class="form-horizontal" role="form" method="POST" action="/register">
                        {{ csrf_field() }}

                        <input type="text" name="name" value="Name" onFocus="if (this.value == 'Name') this.value = '';" onBlur="if (this.value == '') this.value = 'Name';" />
                        <input type="text" name="email" value="Email" onFocus="if (this.value == 'Email') this.value = '';" onBlur="if (this.value == '') this.value = 'Email';" />

                        <input class="last" type="password" name="password" value="Password" onFocus="if (this.value == 'Password') this.value = '';" onBlur="if (this.value == '') this.value = 'Password';" />
                        <input class="last" type="password" name="password_confirmation" value="Re-type Password" onFocus="if (this.value == 'Re-type Password') this.value = '';" onBlur="if (this.value == '') this.value = 'Re-type Password';" />
                        <div class="clearfix">
                            <div class="pull-left"><input type="checkbox" id="categorymanufacturer1" /><label for="categorymanufacturer1">Keep me signed</label></div>
                            <div class="pull-right"><a class="forgot_pass" href="javascript:void(0);" >Forgot password?</a></div>
                        </div>
                        <div class="center"><input type="submit" value="Register"></div>
                    </form>
                </div>
            </div>

            <div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection