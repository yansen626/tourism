
<!-- login popup-->
<div class="login-popup">
    <div class="login-popup-wrap">
        <div class="title-wrap">
            <h2>Login</h2><i class="close-button flaticon-close"></i>
        </div>
        <div class="login-content">
            {{ Form::open(['route'=>['signin'],'method' => 'post','id' => 'general-form']) }}
                <input type="text" name="email" value="" size="40" placeholder="Enter Your Email ..." aria-required="true" class="form-row form-row-first">
                <input type="password" name="password" value="" size="40" placeholder="Enter Your Password ..." aria-required="true" class="form-row form-row-last">
                <div class="remember">
                    <div class="checkbox">
                        <input id="checkbox30" type="checkbox" value="None" name="check">
                        <label for="checkbox30">Remember Me</label>
                    </div><a href="#">Forgot Password ?</a>
                </div><input type="submit" class="cws-button gray alt full-width mt-20">Login now</input>
            {{ Form::close() }}
        </div>
        <div class="login-bot">
            <p>No account yet? <a href="{{ route('register') }}">Register now</a></p>
        </div>
    </div>
</div>
<!-- ! login popup-->