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
                        <h2 class="title-section alt gray mb-20 font-bold"><span>Extenuating Circumstances Policy?</span></h2>
                        <!-- ! section title-->
                        <p class="mb-30">
                            Valid circumstances include:
                        </p>
                        <p class="mb-30">
                            1.	Unexpected death or serious illness of a host, guest or immediate family member (spouse/partner, child, parent, legal guardian, grandparent, or sibling)
                        </p>
                        <p class="mb-30">
                            2.	Serious injury that directly restricts a guest’s ability to travel or a host’s ability to host
                        </p>
                        <p class="mb-30">
                            3.	Significant natural disasters or severe weather incidents impacting the location of destination or location of departure
                        </p>
                        <p class="mb-30">
                            4.	Urgent travel restrictions or severe security advisories issued after the time of booking, by an appropriate national or international authority (such as a government office or department)
                        </p>
                        <p class="mb-30">
                            5.	Endemic disease declared by a credible national or international authority (such as the US Centers for Disease Control or the World Health Organization)
                        </p>
                        <p class="mb-30">
                            6.	Government-mandated obligations issued after the time of booking (ex: jury duty, court appearances, military or government assignments)
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