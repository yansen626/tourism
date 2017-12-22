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
                        <h2 style="text-align: center;">Masuk Lowids</h2>

                        @if($errors->count() > 0)
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br/>
                                @endforeach
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('signin') }}">
                            {{ csrf_field() }}

                            <input type="text" name="email" placeholder="Email" />
                            <input type="password" name="password" placeholder="Kata Sandi"/>
                            <div class="clearfix">
                                <div class="pull-left"><input type="checkbox" id="categorymanufacturer1" name="remember"/><label for="categorymanufacturer1">Ingat Saya</label></div>
                                <div class="pull-right"><a class="forgot_pass" href="/password/reset" >Lupa Kata Sandi?</a></div>
                            </div>
                            {{ Form::hidden('redirect', '', array('id' => 'redirect', 'value' => $redirect)) }}
                            <div class="center"><input type="submit" value="Masuk ke Lowids"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>

            {{--<div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>--}}
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection