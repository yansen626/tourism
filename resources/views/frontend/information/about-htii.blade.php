@extends('layouts.frontend_2')

@section('body-content')
    <div class="content-body">
        <!-- page section about-->
        <section class="small-section cws_prlx_section">
            <img src="{{ URL::asset('frontend_images/bg2.jpg') }}" alt class="cws_prlx_layer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-md-60">
                        &nbsp;<br>
                        &nbsp;<br>
                        &nbsp;<br>
                        &nbsp;
                    </div>
                </div>
            </div>
        </section>
        <!-- ! page section about-->
        <!-- section parallax counter-->
        <section class="small-section">
            <div class="container">
                <div class="row">

                    @include('frontend.information.partials._left-side')
                    <div class="col-md-6 mb-md-60">
                        <!-- section title-->
                        <h2 class="title-section alt gray mb-20 font-bold"><span>WHY CHOOSE US</span></h2>
                        <!-- ! section title-->
                        <h4 class="title-section alt gray mb-20 font-bold"><span>RELIABLE PARTNER (YOU CAN RELY ON US)</span></h4>
                        <p class="mb-30">
                            •	Every experience are count, for the travellers and travel mates, we want to be able to trust each other’s reliability;
                        </p>
                        <p class="mb-30 indent">
                            o	Providing the complete and right information is a must, the inclusion and exclusion, the vehicle type and the personal detail.
                        </p>
                        <p class="mb-30 indent">
                            o	Breaking the commitment is not accepted, you should not cancel after the deadlines set in the relevant cancelation policy, fail to come without information, fail to pay or break the rules stated from the travel mates
                        </p>
                        <p class="mb-30">
                            •	All our travel mates legality and trustworthiness have been verified. They are local people, who understand the detail of the trip, they know what to do, what to eat, where to stay and most important they know how to make extraordinary experiences.
                        </p>
                        <p class="mb-30">
                            •	100% guarantee, program will be executed as written
                        </p>
                        <p class="mb-30">
                            •	We guarantee that all the reviews are left by real travellers based on their personal experience
                        </p>

                        <h4 class="title-section alt gray mb-20 font-bold"><span>SERVICE QUALITY ASSURANCE (LET US SERVE YOU WELL)</span></h4>
                        <p class="mb-30">
                            •	Your experiences should be full of wonderful experiences and enjoyable moments, our service is make sure that everyone meet the objectives
                        </p>
                        <p class="mb-30">
                            •	Travellers safety and satisfy are important for us, we are here 24/7 to listen and serve you
                        </p>
                        <p class="mb-30">
                            •	We ensure that we will answer all the question within 24 hours
                        </p>
                        <p class="mb-30">
                            •	As safety is really important for us, we are taking seriously for any violence acts; physical or sexual abuse, robbery, human trafficking, drugs, including terrorist, or any other criminal activities.
                        </p>
                        <p class="mb-30">
                            •	Our travel mates will be trained and equipped by several skills; foreign languages, excellence services, technologies and management, so they will be ready to give better services and better experiences to every travellers
                        </p>


                        <h4 class="title-section alt gray mb-20 font-bold"><span>SECURED & TRUSTED </span></h4>
                        <p class="mb-30">
                            •	Your personal information are important for us as much as for you, we are using technology to make sure all personal information is safe with us
                        </p>
                        <p class="mb-30">
                            •	We are using Midtrans, a leading and trusted e-payment platform in Indonesia; shopping with us is safe and easy
                        </p>
                        <p class="mb-30">
                            •	Don't worry, to keep safe for both party, we keep half your money until you finish your experience
                        </p>


                        <h4 class="title-section alt gray mb-20 font-bold"><span>EASY AND FRIENDLY</span></h4>
                        <p class="mb-30">
                            •	Do you have questions? Or need anything else? You can discuss your trip with us.
                        </p>
                        <p class="mb-30">
                            •	Click and Confirm! Find your preferable trip and go! Let us do the rest.
                        </p>
                    </div>
                    @include('frontend.information.partials._right-side')
                </div>
            </div>
        </section>
        <!-- ! section parallax counter-->
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <style>
        p{
            color:black;
        }
        .indent{
            text-indent: 10%;
        }
    </style>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
    </script>
@endsection