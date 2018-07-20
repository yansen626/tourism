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
                        <h2 class="title-section alt gray mb-20 font-bold"><span>CANCELATION POLICY – for Traveler</span></h2>
                        <h4 class="title-section alt gray mb-20 font-bold"><span>General Cancellation</span></h4>
                        <!-- ! section title-->
                        <p class="mb-30">
                            1.	Any experience cancellation that is 14 days or more before the start date, is eligible for a 50% refund
                        </p>
                        <p class="mb-30">
                            2.	Cancellations less than 14 days before start date will not be eligible for a refund.
                        </p>
                        <p class="mb-30">
                            3.	Please note that refund process need max 14 working days.
                        </p>
                        <p class="mb-30">
                            4.	However, if your reason for cancellation meets our Extenuating Circumstances policy, you will be refunded in full within 14 working days
                        </p>

                        <h4 class="title-section alt gray mb-20 font-bold"><span>Weather</span></h4>
                        <p class="mb-30">
                            Travel Mates make every effort to continue, as scheduled, with experiences or events. Should bad weather conditions create an unsafe scenario for travelers or Travel Mates, a change or partial cancellation of an itinerary or activity may be the result. Should an individual experience or event be canceled by travel mate or traveler, or should an itinerary substantially change or result in a cessation of the trip, Hello This is Indonesia will work with Travel Mate to provide an appropriate refund.
                        </p>
                        <p class="mb-30">
                            To officially request a cancellation of your experience or event, please contact us.
                        </p>

                        <!-- section title-->
                        <h2 class="title-section alt gray mb-20 font-bold"><span>CANCELATION POLICY – for Travel Mates</span></h2>
                        <!-- ! section title-->
                        <p class="mb-30">
                            Travel Mate is prohibited to cancel any program that has been confirmed, full or half program.
                        </p>
                        <p class="mb-30">
                            Because cancellations disrupt guests' plans and impact confidence in the Hello This is Indonesia’s community, the following penalties will be applied for travel mate cancellations
                        </p>
                        <p class="mb-30">
                            Travel Mate guarantee the program will run as written, so to any cancelation made by travel mate will be subjected to Rp. 250.000/pax penalty and 100% full refund
                        </p>
                        <p class="mb-30">
                            <b>Automated review.</b> If you cancel the program, an automated review will be posted on your profile indicating that you canceled one of the reservations. This review can’t be removed.
                        </p>
                        <p class="mb-30">
                            <b>Traveler review.</b> Traveler may leave a public review according to your cancelation on your listed profile.
                        </p>
                        <p class="mb-30">
                            <b>Account suspension.</b> If you cancel 3 or more reservations within a year, we may deactivate your listing.
                        </p>
                        <p class="mb-30">
                            However, if your cancelation meets our Extenuating Circumstances policy, we would like to understand and discuss the solution together with you.
                        </p>

                        <h5 class="title-section alt gray mb-20 font-bold"><span>TRAVEL MATE CANCEL – ADMIN CALL, DISCUSS AND FIND SOLUTION – TO ANY REFUND PAID IN 14 DAYS </span></h5>


                        <!-- section title-->
                        <h2 class="title-section alt gray mb-20 font-bold"><span>REFUND PROCESS</span></h2>
                        <!-- ! section title-->
                        <p class="mb-30">
                            1.	Traveller / Travel Mates request cancel
                        </p>
                        <p class="mb-30">
                            2.	Admin process in 24 hours – Email confirmation
                        </p>
                        <p class="mb-30">
                            3.	Traveler / Travel Mates disagree – reply email
                        </p>
                        <p class="mb-30">
                            4.	No reply = Agree
                        </p>
                        <p class="mb-30">
                            5.	Refund Process 14 working days – refund to the credit card or transfer to local bank account.
                        </p>
                        <p class="mb-30">
                            6.	Refund based on Rupiah
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
    </style>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
    </script>
@endsection