@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="login">
                        <h2 class="text-center">Ubah Kata Sandi</h2>

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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('user/password/save') }}">
                            {{ csrf_field() }}

                            <input type="password" id="current-password" name="current-password" placeholder="Kata Sandi Sekarang"/>
                            <input type="password" id="password" name="password" placeholder="Kata Sandi Baru"/>
                            <input type="password" id="password-confirmation" name="password-confirmation" placeholder="Konfirmasi Kata Sandi"/>
                            <div class="center"><input type="submit" value="Ubah"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>

            {{--<div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>--}}
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection