@extends('layouts.frontend')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div>
            <div class="row">
                <div class="col-md-2">
                    <div class="wrapper-sticky" style="display: block; height: 291px; width: 220px; margin: auto; position: relative; float: left; left: auto; right: auto; top: auto; bottom: auto; vertical-align: top;">
                        <div style="top: 0px; bottom: auto; float: left; left: 0px; right: auto; position: absolute;">

                            <span class="title-section mt-0 mb-0" style="font-size: 20px;">left side</span><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="">
                        <div class="col-md-12 mb-md-70">
                            <h1>content content content content content content content content content content content content </h1>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- section title-->
                    <span class="title-section mt-0 mb-0" style="font-size: 20px;">right side</span><br>
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection