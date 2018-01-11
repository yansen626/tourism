@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">
            <div class="my_account_block clearfix">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div>
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="login text-center">
                        <h2>Profil Pribadi</h2>
                        <p class="profile_font">
                            {{\Illuminate\Support\Facades\Auth::user()->first_name}} {{\Illuminate\Support\Facades\Auth::user()->last_name}}
                            <br/>
                            {{\Illuminate\Support\Facades\Auth::user()->email}}
                            <br/>
                            {{\Illuminate\Support\Facades\Auth::user()->phone}}
                        </p>
                        <div class="center"><a class="btn" href="{{ route('user-edit') }}" >Ubah</a></div>
                        <div class="center" style="margin-top: 1em; margin-bottom: 2em;"><a class="btn" href="{{ route('password-edit') }}" >Ganti Kata Sandi</a></div>

                        <h2>Alamat</h2>

                        @if($address != '' && $address!= null)
                            <p class="profile_font">
                                {{ $address->name }}
                                <br/>
                                {{ $address->detail }}
                                <br/>
                                {{ $address->city_name }}, {{ $address->subdistrict_name }}<br/>
                                {{ $address->province_name }} {{ $address->postal_code }}
                            </p>
                            <div class="center"><a class="btn" href="{{ route('user-address-edit') }}" >Ubah Alamat</a></div>
                        @else
                            <div class="center"><a class="btn" href="{{ route('user-address-create') }}" >Tambah Alamat</a></div>
                        @endif

                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection