@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.traveler.partials._left-side')
                </div>
                <div class="col-md-7">
                    <div class="">
                        <div class="col-md-12 mb-md-70">
                            <h1>Content</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('frontend.traveler.partials._right-side')
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


    @include('frontend.partials._modal-login')
@endsection