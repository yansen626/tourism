@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                @if(auth()->guard('travelmates')->check())
                    @if(\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->id == $user->id)
                        @include('frontend.travelmate.partials._left-side')
                        @php($class='col-md-7')
                    @endif
                @else
                    @php($class='col-md-10 col-md-offset-1')
                @endif

                <div class="{{$class}}">
                    <div class="">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="col-md-12">
                                <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-round"></i>{{ \Illuminate\Support\Facades\Session::get('message') }}
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12 mb-md-70">
                            <div class="col-md-4">
                                <img class="img-circle" src="{{ URL::asset('storage/profile/'. $user->profile_picture ) }}" style="width:200px;height:200px;">
                            </div>
                            <div class="col-md-8">

                                @if(auth()->guard('travelmates')->check())
                                    @if(\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->id == $user->id)
                                        <div class="pull-right mt-10">
                                            <a href="{{ route('travelmate.profile.edit') }}" class="btn btn-default" style="background-color: #EB5532; color:white;">
                                                EDIT
                                            </a>
                                        </div>
                                        <h4>MY PROFILE</h4>
                                    @endif
                                @else
                                    <h4>TRAVELMATE PROFILE</h4>
                                @endif
                                <hr>
                                <h5>{{ $user->first_name. ' '. $user->last_name }}</h5>
                                <span>Jakarta</span>
                                <br>
                                <span>My Point : 10</span>
                                <br>
                                <span>REVIEWS : 10</span>
                                <br>

                                @php($star = "stars-".$user->rating)
                                <div class="stars {{$star}}"></div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>ABOUT ME</h4>
                                <span>
                                    {{ $user->about_me }}
                                </span>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>BASIC INFO</h4>
                                <div class="col-md-3">
                                    First Name
                                </div>
                                <div class="col-md-9">
                                    : {{ ucfirst($user->first_name) }}
                                </div>
                                <div class="col-md-3">
                                    Surname
                                </div>
                                <div class="col-md-9">
                                    : {{ ucfirst($user->last_name) }}
                                </div>
                                <div class="col-md-3">
                                    Sex
                                </div>
                                <div class="col-md-9">
                                    :  {{ ucfirst($user->sex) }}
                                </div>
                                <div class="col-md-3">
                                    Email
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->email }}
                                </div>
                                <div class="col-md-3">
                                    Phone No.
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->phone }}
                                </div>
                                <div class="col-md-3">
                                    Occupation
                                </div>
                                <div class="col-md-9">
                                    : {{$user->occupation}}
                                </div>
                                <div class="col-md-3">
                                    Nationality
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->nationality ?? '-' }}
                                </div>
                                <div class="col-md-3">
                                    Date of Birth
                                </div>
                                <div class="col-md-9">
                                    : {{ \Carbon\Carbon::parse($user->dob)->format('d F Y') ?? '-' }}
                                </div>
                                <div class="col-md-3">
                                    Current Location
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->current_location ?? '-' }}
                                </div>
                                <div class="col-md-3">
                                    Address
                                </div>
                                <div class="col-md-9">
                                    : {{$user->address}}
                                </div>
                                <div class="col-md-3">
                                    City/Town
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->city->name }}
                                </div>
                                <div class="col-md-3">
                                    Province/State
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->province->name }}
                                </div>
                                <div class="col-md-3">
                                    Postal Code
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->postal_code }}
                                </div>
                                <div class="col-md-3">
                                    Nationality
                                </div>
                                <div class="col-md-9">
                                    : {{$user->nationality}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>VERIFIED ID</h4>
                                {{--<div class="col-md-3">--}}
                                    {{--Identification--}}
                                {{--</div>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--: {{ $identity }}--}}
                                {{--</div>--}}
                                <div class="col-md-3">
                                    ID Card (No.ID)
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->id_card }}
                                </div>
                                <div class="col-md-3">
                                    Passport No
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->passport_no }}
                                </div>
                                <div class="col-md-3">
                                    Driving License No
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->driving_license }}
                                </div>

                                @if(auth()->guard('travelmates')->check())
                                    @if(\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->id == $user->id)
                                        <div class="col-md-7">
                                            <img src="{{ URL::asset('storage/travelmate_ktp/'.$user->ktp_img) }}">
                                            {{--<button class="btn btn-default" style="background-color: #EB5532; color:white;">Upload Id</button>--}}
                                        </div>
                                    @endif
                                @endif
                                <div class="col-md-5">
                                    &nbsp;
                                </div>

                                {{--@if($identity === 'ID CARD')--}}
                                    {{--<div class="col-md-3">--}}
                                        {{--ID Card (No.ID)--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--: {{ $user->id_card }}--}}
                                    {{--</div>--}}
                                {{--@elseif($identity === 'PASSPORT')--}}
                                    {{--<div class="col-md-3">--}}
                                        {{--Passport No--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--: {{ $user->passport }}--}}
                                    {{--</div>--}}
                                {{--@endif--}}


                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>OTHERS</h4>
                                <div class="col-md-3">
                                    Speaking Languages
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->speaking_language ?? '-' }}
                                </div>
                                <div class="col-md-3">
                                    Travel Category
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->travel_interest ?? '-' }}

                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>

                                @if(auth()->guard('travelmates')->check())
                                    @if(\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->id == $user->id)
                                        <div class="pull-right mt-10">
                                            <a href="{{ route('travelmate.profile.edit') }}" class="btn btn-default" style="background-color: #EB5532; color:white;">
                                                EDIT
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                <h4>Travel Diary</h4>
                                <div class="col-md-3">
                                    By {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe src="https://www.youtube.com/embed/ojQbArbuN4E" class="embed-responsive-item"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->guard('travelmates')->check())
                    @if(\Illuminate\Support\Facades\Auth::guard('travelmates')->user()->id == $user->id)
                        <div class="col-md-3">
                            @include('frontend.travelmate.partials._right-side')
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection