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
                        <h2 style="text-align: center;">Daftar Akun Baru</h2>

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

                            <input type="email" name="email" placeholder="Alamat Email" />
                            <input type="text" name="first_name" placeholder="Nama Depan"/>
                            <input type="text" name="last_name" placeholder="Nama Belakang" />
                            <input type="text" name="phone" placeholder="Nomor Ponsel" />

                            <input class="last" type="password" name="password" placeholder="Kata Sandi"/>
                            <input class="last" type="password" name="password_confirmation" placeholder="Ulang Kata Sandi" />
                            <p style="text-align: center;">Dengan mengeklik Buat Akun, maka Anda setuju dengan <a href="{{ route('terms-show') }}" style="text-decoration: underline;">Syarat dan Ketentuan</a> kami</p>
                            <div class="center"><input type="submit" value="Buat Akun"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection