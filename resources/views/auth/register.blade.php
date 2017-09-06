@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">
            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Create New User</h2>
                    @foreach($errors->all() as $error)
                        <h5 style="color: red;"> {{ $error }} </h5>
                    @endforeach
                    <form class="form-horizontal" role="form" method="POST" action="/register">
                        {{ csrf_field() }}

                        <input type="text" name="email" value="Email" onFocus="if (this.value == 'Email') this.value = '';" onBlur="if (this.value == '') this.value = 'Email';" />
                        <input type="text" name="first_name" value="Fist name" onFocus="if (this.value == 'First Name') this.value = '';" onBlur="if (this.value == '') this.value = 'First Name';" />
                        <input type="text" name="last_name" value="Last Name" onFocus="if (this.value == 'Last Name') this.value = '';" onBlur="if (this.value == '') this.value = 'Last Name';" />

                        <input class="last" type="text" name="password" value="Password" onFocus="if (this.value == 'Password') this.value = '';" onBlur="if (this.value == '') this.value = 'Password';" />
                        <input class="last" type="text" name="password_confirmation" value="Re-type Password" onFocus="this.type='password'; if (this.value == 'Re-type Password') this.value = '';" onBlur="if (this.value == '') this.value = 'Re-type Password';" />
                        <div class="clearfix">
                            <div class="pull-left"><input type="checkbox" id="categorymanufacturer1" /><label for="categorymanufacturer1">Keep me signed</label></div>
                            <div class="pull-right"><a class="forgot_pass" href="javascript:void(0);" >Forgot password?</a></div>
                        </div>
                        <div class="center"><input type="submit" value="Register"></div>
                    </form>
                </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection