@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div style="margin:3%;">
            <h2 class="title-section mb-5 text-center">
                Your Transaction <span>Success</span>
            </h2>
                <!-- ! content-->
        </div>
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection