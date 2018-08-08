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

                                    @if($user->travel_interest == null)
                                        <p>: -</p>
                                    @else
                                        @php($categories = preg_split('@;@', $user->travel_interest, NULL, PREG_SPLIT_NO_EMPTY))
                                        @foreach($categories as $category)
                                            <img src="{{ URL::asset('frontend_images/categories/'.$category.".png") }}" style="width: 70px;padding-bottom: 10px;">
                                        @endforeach
                                    @endif
                                    {{--: {{ $user->travel_interest ?? '-' }}--}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right mt-10">
                                    <a href="{{ route('traveller.profile.diary') }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
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

                                    <div class="container-fluid">
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                @php($ct = 0)
                                                @foreach($diaries as $diary)
                                                    @if($ct == 0)
                                                        @php($class = 'item active')
                                                    @else
                                                        @php($class = 'item')
                                                    @endif
                                                    <div class="{{$class}}" >
                                                        <div>
                                                            @if(!empty($diary->youtube_link))
                                                                <div class="embed-responsive embed-responsive-4by3" >
                                                                    <!-- Copy & Pasted from YouTube -->
                                                                    <iframe src="{{$diary->youtube_link}}" class="embed-responsive-item"></iframe>
                                                                </div>
                                                            @else
                                                                <div class="text-center">
                                                                    <img src="{{ URL::asset('storage/traveller_diary/'.$diary->image_link) }}" style="height:500px;width:auto;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div style="padding: 3%;"> <!-- class="carousel-caption" into image -->
                                                            {{$diary->description}}
                                                        </div>
                                                    </div>
                                                    @php($ct++)
                                                @endforeach
                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('frontend.traveler.partials._right-side', ['allPackage'=>$allPackages, 'HistoryPackages'=>$HistoryPackages, 'upcomingPackages'=>$upcomingPackages])
                    @include('frontend.traveler.partials._right-side')
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <style>
        .container-fluid {
            background: #000000;
            color:#ffffff;
            margin: 40px auto 10px;
            padding: 20px 0px;
            max-width: 960px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        .embed-responsive-4by3 {
            padding-bottom: 58%;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>// Carousel Auto-Cycle
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 0
            })
        });
    </script>
@endsection