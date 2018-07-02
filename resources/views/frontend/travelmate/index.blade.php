@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin:3%;">
            <div class="row" style="padding-bottom:15%;">

                @foreach($travelmates as $travelmate)
                    <div class="col-md-4">
                    <!-- testimonial item-->
                        @php($star = "stars-".$travelmate->rating)
                        <div class="testimonial-item">
                            <div class="testimonial-top">
                                <a href="#">
                                    <div class="pic">
                                        <img src="{{ URL::asset('storage/travelmate_banner/'.$travelmate->banner_picture) }}"
                                             data-at2x="{{ URL::asset('storage/travelmate_banner/'.$travelmate->banner_picture) }}" alt>
                                    </div>
                                </a>
                                <div class="author">
                                    <img src="{{ URL::asset('storage/profile/'.$travelmate->profile_picture) }}"
                                         data-at2x="{{ URL::asset('storage/profile/'.$travelmate->profile_picture) }}" alt>
                                </div>
                            </div>
                            <!-- testimonial content-->
                            <div class="testimonial-body">
                                <h5 class="title"><span>{{$travelmate->first_name}}</span> {{$travelmate->last_name}}</h5>
                                <div class="stars {{$star}}"></div>
                                <p class="align-center">
                                    {{$travelmate->description}}
                                </p><a href="#" class="testimonial-button">Visit Profile</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <!-- testimonial carousel-->
                <div class="owl-three-item">

                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection