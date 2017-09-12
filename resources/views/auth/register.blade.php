@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">
            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Register</h2>

                    @if($errors->count() > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/register">
                        {{ csrf_field() }}

                        <input type="email" name="email" placeholder="Email" />
                        <input type="text" name="first_name" placeholder="Fist name"/>
                        <input type="text" name="last_name" placeholder="Last Name" />
                        <input type="text" name="phone" placeholder="Phone Number" />

                        <input class="last" type="password" name="password" placeholder="Password"/>
                        <input class="last" type="password" name="password_confirmation" placeholder="Re-type Password" />
                        <div class="center"><input type="submit" value="Register"></div>
                    </form>
                </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection