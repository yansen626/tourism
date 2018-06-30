@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin-top:3%;">
            <div class="row">
                @include('frontend.traveler.partials._left-side', $user)
                <div class="col-md-7">
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
                                <img class="img-circle" src="{{ URL::asset('storage/profile/'.$user->img_path) }}" style="width:200px;height:200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT

                                    </a>
                                </div>
                                <h4>MY PROFILE</h4>
                                <hr>
                                <h5>{{ $user->first_name. ' '. $user->last_name }}</h5>
                                <span>Jakarta</span>
                                <br>
                                <span>My Point : </span><span style="background-color:blue; color:white;">&nbsp;&nbsp;{{ $user->total_point}}&nbsp;&nbsp;</span>
                                <br>
                                <span>REVIEWS : {{ $user->total_review}}</span>
                                <br>

                                @php($star = "stars-".$user->rating)
                                <div class="stars {{$star}}"></div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT
                                    </a>
                                </div>
                                <h4>ABOUT ME</h4>
                                <span>
                                    {{ $user->about_me }}
                                </span>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT
                                    </a>
                                </div>
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
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT
                                    </a>
                                </div>
                                <h4>VERIFIED ID</h4>
                                <div class="col-md-3">
                                    Identification
                                </div>
                                <div class="col-md-9">
                                    : {{ $identity }}
                                </div>

                                @if($identity === 'ID CARD')
                                    <div class="col-md-3">
                                        ID Card (No.ID)
                                    </div>
                                    <div class="col-md-9">
                                        : {{ $user->id_card }}
                                    </div>
                                @elseif($identity === 'PASSPORT')
                                    <div class="col-md-3">
                                        Passport No
                                    </div>
                                    <div class="col-md-9">
                                        : {{ $user->passport }}
                                    </div>
                                @endif


                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT
                                    </a>
                                </div>
                                <h4>OTHERS</h4>
                                <div class="col-md-3">
                                    Speaking Languages
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->speaking_language ?? '-' }}
                                </div>
                                <div class="col-md-3">
                                    Travel Interest
                                </div>
                                <div class="col-md-9">
                                    : {{ $user->travel_interest ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.edit') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                        EDIT
                                    </a>
                                </div>
                                <h4>Travel Diary</h4>
                                <div class="col-md-3">
                                    By {{ $user->first_name. ' '. $user->last_name }}
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe src="{{$user->youtube_link}}" class="embed-responsive-item"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
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