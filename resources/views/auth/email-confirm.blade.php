@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <p style="font-size: 15px;">Your Email is successfully verified. Click here to <strong><a href="{{ route('login') }}">login</a></strong></p>
                </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection