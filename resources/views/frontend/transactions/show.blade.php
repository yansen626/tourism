@extends('layouts.frontend_2')

@section('body-content')
    <!-- content-->
    <div class="content-body">
        {{--<div class="container page">--}}
        <div style="margin:3%;">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="col-md-12">
                        <img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}">
                    </div>
                    <div class="col-md-12">
                        <h4>{{$package->name}}</h4>

                    </div>
                    <div class="col-md-3">
                        <p>PARTICIPANTS : </p>
                    </div>
                    <div class="col-md-9">
                        <p>
                            Mr. Budi <br>
                            Ms. Listyani Lee <br>
                            Ms. Cynthia Lesmana
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>DESTINATION : </p>
                    </div>
                    <div class="col-md-9">
                        <p>{{$package->name}}, {{$package->province->name}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>SCHEDULE : </p>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="daterange" value="03/08/2018 - 11/08/2018" />
                    </div>
                    <div class="col-md-3">
                        <p>TRAVEL MATE : </p>
                    </div>
                    <div class="col-md-9">
                        <p style="font-size: 16px;">
                            <a href="{{ route('travelmate.profile.showid', ['id'=>$package->travelmate_id]) }}">
                                {{$package->travelmate->first_name}} {{$package->travelmate->last_name}}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <span>PRICE : </span>
                    </div>
                    <div class="col-md-9">
                        <span> {{$package->price}}</span>
                    </div>
                    <div class="col-md-12">
                        <span>PROGRAM : </span>
                        <br>
                        <textarea> asdfadsfds \n safdfadf </textarea>
                        <br>

                        <a href="#" class="btn btn-default" style="background-color: #ffc801; color:white;">
                            Download PDF
                        </a>
                    </div>
                    <div class="col-md-12">
                        <span>ADD ONS </span>
                    </div>
                    <div class="col-md-3">
                        <span>PAYMENT STATUS : </span>
                    </div>
                    <div class="col-md-9">
                        <span> 50%</span>
                    </div>
                    <div class="col-md-3">
                        <span>RATING : </span>
                    </div>
                    <div class="col-md-9">
                        @php($star = "stars-".$package->travelmate->rating)
                        <div class="stars {{$star}}"></div>
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="#" class="btn btn-danger" >
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection


@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function () {
            // $('.daterangepicker.dropdown-menu.ltr.show-calendar.opensleft').show();
            $(".daterangepicker").show();
        });

        $(function() {
            $('input[name="daterange"]').daterangepicker({
                autoApply: true,
                alwaysShowCalendars: true,
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));


            });
        });
    </script>
@endsection