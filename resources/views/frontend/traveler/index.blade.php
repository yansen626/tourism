@extends('layouts.frontend')

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
                            <div class="col-md-4">
                                <img class="img-circle" src="{{ URL::asset('storage/profile/profile3.jpg') }}" style="width:200px;height:200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="pull-right mt-10">
                                    <a href="#" class="btn btn-default">EDIT</a>
                                </div>
                                <h4>MY PROFILE</h4>
                                <hr>
                                <h5>Anne Frank</h5>
                                <span>Jakarta, INA</span>
                                <br>
                                <span>My Point : 10</span>
                                <br>
                                <span>REVIEWS : 10</span>
                                <br>

                                <div class="stars stars-5"></div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>ABOUT ME</h4>
                                <span>
                                    Description Description Description Description Description Description Description Description Description
                                    Description Description Description Description Description Description Description Description Description
                                    Description Description Description Description Description Description Description Description Description
                                    Description Description Description Description Description Description Description Description Description
                                </span>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>BASIC INFO</h4>
                                <div class="col-md-3">
                                    First Name
                                </div>
                                <div class="col-md-9">
                                    : Anne
                                </div>
                                <div class="col-md-3">
                                    Surname
                                </div>
                                <div class="col-md-9">
                                    : Frank
                                </div>
                                <div class="col-md-3">
                                    Sex
                                </div>
                                <div class="col-md-9">
                                    : Female
                                </div>
                                <div class="col-md-3">
                                    Email
                                </div>
                                <div class="col-md-9">
                                    : annefrank@gmail.com
                                </div>
                                <div class="col-md-3">
                                    Phone No.
                                </div>
                                <div class="col-md-9">
                                    : 1234567890
                                </div>
                                <div class="col-md-3">
                                    Nationality
                                </div>
                                <div class="col-md-9">
                                    : France
                                </div>
                                <div class="col-md-3">
                                    Date of Birth
                                </div>
                                <div class="col-md-9">
                                    : 12-03-88
                                </div>
                                <div class="col-md-3">
                                    Current Location
                                </div>
                                <div class="col-md-9">
                                    : France
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>VERIFIED ID</h4>
                                <div class="col-md-3">
                                    ID Card (No.ID)
                                </div>
                                <div class="col-md-9">
                                    : 11111111
                                </div>
                                <div class="col-md-3">
                                    Passport No
                                </div>
                                <div class="col-md-9">
                                    : 222222
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>OTHERS</h4>
                                <div class="col-md-3">
                                    Speaking Languages
                                </div>
                                <div class="col-md-9">
                                    : France, English
                                </div>
                                <div class="col-md-3">
                                    Travel Interest
                                </div>
                                <div class="col-md-9">
                                    : 222222
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>Travel Diary</h4>
                                <div class="col-md-3">
                                    By
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
                <div class="col-md-3">
                    @include('frontend.traveler.partials._right-side')
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection