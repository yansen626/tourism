@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin:3%;">
            <div class="row" style="padding-bottom:15%;">

                @foreach($travellers as $traveller)
                    <div class="col-md-4">
                    <!-- testimonial item-->
                        @php($star = "stars-".$traveller->rating)
                        <div class="testimonial-item">
                            <div class="testimonial-top">
                                <a href="#">
                                    {{--<div class="pic">--}}
                                        {{--<img src="{{ URL::asset('storage/travelmate_banner/') }}"--}}
                                             {{--data-at2x="{{ URL::asset('storage/travelmate_banner/') }}" alt>--}}
                                    {{--</div>--}}
                                </a>
                                <div class="author" style="width: 100px;">
                                    <img src="{{ URL::asset('storage/profile/'.$traveller->img_path) }}"
                                         data-at2x="{{ URL::asset('storage/profile/'.$traveller->img_path) }}" alt>
                                </div>
                            </div>
                            <!-- testimonial content-->
                            <div class="testimonial-body">
                                <h5 class="title"><span>{{$traveller->first_name}}</span> {{$traveller->last_name}}</h5>
                                <div class="stars {{$star}}"></div>
                                <p class="align-center">
                                    {{$traveller->about_me}}
                                </p><a href="/traveller/show?userId={{$traveller->id}}" class="testimonial-button">Visit Profile</a>
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