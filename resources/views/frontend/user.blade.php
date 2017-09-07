@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">
            <div class="my_account_block clearfix">
                <div>
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="login">
                    <h2>User Data</h2>
                    <p>
                        Name: {{\Illuminate\Support\Facades\Auth::user()->first_name}} {{\Illuminate\Support\Facades\Auth::user()->last_name}}
                        <br/>
                        Email: {{\Illuminate\Support\Facades\Auth::user()->email}}
                        <br/>
                        Phone: {{\Illuminate\Support\Facades\Auth::user()->phone}}
                    </p>
                    <div class="center"><a class="btn active" href="{{ route('user-edit-show') }}" >Edit</a></div>
                    <br/>
                </div>
                <div class="new_customers">
                    <h2>Address</h2>

                    @if($address != '' && $address!= null)
                        <p>
                            {{ $address->name }}
                            <br/>
                            {{ $address->detail }}
                            <br/>
                            {{ $address->city_name }}, {{ $address->province_name }}
                        </p>
                        <div class="center"><a class="btn active" href="{{ route('user-address-edit') }}" >Edit Address</a></div>
                    @else
                        <div class="center"><a class="btn active" href="{{ route('user-address-create') }}" >Add Address</a></div>
                    @endif
                </div>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection