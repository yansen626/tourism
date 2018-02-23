@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <p style="font-size: 15px;">Email verifikasi telah dikirim ke {{ $email }}</p>
                </div>
            </div>

            {{--<div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>--}}
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection