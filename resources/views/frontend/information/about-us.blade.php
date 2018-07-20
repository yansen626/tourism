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
                        <h2 class="title-section alt gray mb-20 font-bold"><span>About Us</span></h2>
                        <!-- ! section title-->
                        <h4 class="title-section alt gray mb-20 font-bold"><span>WHO WE ARE</span></h4>
                        <p class="mb-30">
                            #HELLOTHISISINDONESIA is not just a slogan, but its our way to introduce the beauty of Indonesia
                        </p>
                        <p class="mb-30">
                            We are a group of passionate travellers who see Indonesia as one of the world's tourist destinations that can’t be missed
                        </p>
                        <p class="mb-30">
                            Our believe is about changing perspective, traveling is not visiting new places only but experiences the local sensation; natures, cultures, food, spiritual and the way of living that only can do by the locals
                        </p>
                        <p class="mb-30">
                            Connecting through e-commerce platform allowing travellers to connect with the local tours (we call it Travel mates) way much easier
                        </p>
                        <p class="mb-30">
                            We understand that everyone is different and unique and has their own travel style, we create bunch of travel experiences that you can choose your own style; Natural seekers, adventures, art & cultures, voluntourism, history, food, health & spiritual and many others experiences
                        </p>
                        <p class="mb-30">
                            Like the world says, “You Only Live Once” so RISE UP from your comfort zone, GET OUT from your lovely bed and JUMP OFF to your extraordinary experiences, MEET UP with the locals and MAKE UP your entire perspective.
                        </p>
                        <p class="mb-30">
                            Come to Indonesia, see the different, enjoy the different and share the story
                        </p>

                        <h4 class="title-section alt gray mb-20 font-bold"><span>SHARE TO LOCALS</span></h4>
                        <p class="mb-30">
                            Hello This Is Indonesia commits to develop local people and their environment because we want to grow together with the locals. By joining Hello This Is Indonesia, you are with us, growing more homestay, services, education, local restaurants, plantations, eco-environment and many more.
                        </p>


                        <h4 class="title-section alt gray mb-20 font-bold"><span>SHARE TO LOCALS</span></h4>
                        <p class="mb-30">
                            We are a group of passionate travellers who see Indonesia as one of the world's tourist destinations that can’t be missed
                        </p>
                        <p class="mb-30">
                            Our believe is about changing perspective, traveling is not visiting new places only but experiences the local sensation; natures, cultures, food, spiritual and the way of living that only can do by the locals
                        </p>
                        <p class="mb-30">
                            Connecting through e-commerce platform allowing travellers to connect with the local tours (we call it Travel mates) way much easier
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