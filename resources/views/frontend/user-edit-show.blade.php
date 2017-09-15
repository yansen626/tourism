@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="login">
                    <h2>Edit Account Data</h2>

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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('user/edit/save') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3">First Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $data->first_name }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3">Last Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $data->last_name }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3">Phone Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="phone" placeholder="Phone Number" value="{{ $data->phone }}"/>
                            </div>
                        </div>
                        <div class="center"><input type="submit" value="Save"></div>
                    </form>
                </div>
            </div>

            <div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->
@endsection