@extends('layouts.frontend_2')

@section('body-content')
    <div class="content-body">
        <!-- page section about-->
        <section class="small-section cws_prlx_section bg-white-80 pb-0"><img src="pic/parallax-4.jpg" alt class="cws_prlx_layer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-md-60">
                        <!-- section title-->
                        <h2 class="title-section-top alt gray">About</h2>
                        <h2 class="title-section alt gray mb-20 font-bold"><span>Sun</span>Tour</h2>
                        <!-- ! section title-->
                        <p class="mb-30">Vestibulum tincidunt venenatis scelerisque. Proin quis enim lacinia, vehicula massa et, mollis urna. Proin nibh mauris, blandit vitae convallis at, tincidunt vel tellus. Praesent posuere nec lectus non cursus. Sed commodo odio et ipsum sagittis tincidunt.</p>
                        <div class="cws_divider short mb-30"></div>
                        <h3 class="font-medium font-5">Andrew McDonald</h3>
                    </div>
                    <div class="col-md-6 flex-item-end"><img src="pic/promo-2.png" alt class="mt-minus-100"></div>
                </div>
            </div>
        </section>
        <!-- ! page section about-->
        <!-- section parallax counter-->
        <section class="small-section">
            <div class="container">
                <div class="row">
                    <!-- counter blocks-->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-6 mt-20 mb-80">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-world"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="345" class="counter">0</div>
                                        <div class="counter-name">Tours</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 mt-20 mb-80">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-fireworks"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="438" class="counter">0</div>
                                        <div class="counter-name">Holidays</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 mb-80">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-hotel"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="526" class="counter">0</div>
                                        <div class="counter-name">Hotels</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 mb-80">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-ship"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="169" class="counter">0</div>
                                        <div class="counter-name">Cruises</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-airplane"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="293" class="counter">0</div>
                                        <div class="counter-name">Flights</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="counter-block"><i class="counter-icon flaticon-suntour-car"></i>
                                    <div class="counter-name-wrap">
                                        <div data-count="675" class="counter">0</div>
                                        <div class="counter-name">Cars</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ! counter blocks-->
                    <!-- tabs-->
                    <div class="col-md-6 mt-md-40">
                        <div class="tabs">
                            <div class="block-tabs-btn clearfix">
                                <div data-tabs-id="tabs1" class="tabs-btn active">About us</div>
                                <div data-tabs-id="tabs2" class="tabs-btn">Our mission</div>
                                <div data-tabs-id="tabs3" class="tabs-btn">Our vision</div>
                            </div>
                            <!-- tabs keeper-->
                            <div class="tabs-keeper">
                                <!-- tabs container-->
                                <div data-tabs-id="cont-tabs1" class="container-tabs active">
                                    <h6 class="trans-uppercase">Hotel Bohemians</h6>
                                    <p>Duis egestas accumsan ipsum, at volutpat elit imperdiet in. Curabitur lacinia, massa quis elementum bibendum, tellus neque porttitor erat, a ornare enim arcu nec mauris. Morbi ac tristique felis. Praesent cursus placerat risus. Duis ut magna quis sem varius consequat.  </p>
                                    <ul class="style-3">
                                        <li>Nam molestie dolor id auctor sodales;</li>
                                        <li>In sagittis dolor vel turpis aliquet pharetra;</li>
                                        <li>Quisque non turpis in dui congue dapibus;</li>
                                        <li>Vivamus varius nisl quis dictum maximus;</li>
                                        <li>Vestibulum scelerisque ligula quis est faucibus tincidunt.</li>
                                    </ul>
                                </div>
                                <!-- /tabs container-->
                                <!-- tabs container-->
                                <div data-tabs-id="cont-tabs2" class="container-tabs">
                                    <h6 class="trans-uppercase">Hotel Bohemians</h6>
                                    <p>Duis egestas accumsan ipsum, at volutpat elit imperdiet in. Curabitur lacinia, massa quis elementum bibendum, tellus neque porttitor erat, a ornare enim arcu nec mauris. Morbi ac tristique felis. Praesent cursus placerat risus. Duis ut magna quis sem varius consequat.  </p>
                                    <ul class="style-3">
                                        <li>Nam molestie dolor id auctor sodales;</li>
                                        <li>In sagittis dolor vel turpis aliquet pharetra;</li>
                                        <li>Quisque non turpis in dui congue dapibus;</li>
                                        <li>Vivamus varius nisl quis dictum maximus;</li>
                                        <li>Vestibulum scelerisque ligula quis est faucibus tincidunt.</li>
                                    </ul>
                                </div>
                                <!-- /tabs container-->
                                <!-- tabs container-->
                                <div data-tabs-id="cont-tabs3" class="container-tabs">
                                    <h6 class="trans-uppercase">Hotel Bohemians</h6>
                                    <p>Duis egestas accumsan ipsum, at volutpat elit imperdiet in. Curabitur lacinia, massa quis elementum bibendum, tellus neque porttitor erat, a ornare enim arcu nec mauris. Morbi ac tristique felis. Praesent cursus placerat risus. Duis ut magna quis sem varius consequat.  </p>
                                    <ul class="style-3">
                                        <li>Nam molestie dolor id auctor sodales;</li>
                                        <li>In sagittis dolor vel turpis aliquet pharetra;</li>
                                        <li>Quisque non turpis in dui congue dapibus;</li>
                                        <li>Vivamus varius nisl quis dictum maximus;</li>
                                        <li>Vestibulum scelerisque ligula quis est faucibus tincidunt.</li>
                                    </ul>
                                </div>
                                <!-- /tabs container-->
                            </div>
                            <!-- /tabs keeper-->
                        </div>
                    </div>
                    <!-- /tabs-->
                </div>
            </div>
        </section>
        <!-- ! section parallax counter-->
        <!-- testimonials section-->
        <section class="small-section cws_prlx_section bg-gray-40"><img src="pic/parallax-5.jpg" alt class="cws_prlx_layer">
            <div class="container">
                <div class="row">
                    <!-- testimonial item-->
                    <div class="col-md-4 col-sm-6 mb-md-30">
                        <div class="testimonial-item">
                            <div class="testimonial-top"><a href="hotels-details.html">
                                    <div class="pic"><img src="pic/testimonial/top-bg/1.jpg" data-at2x="pic/testimonial/top-bg/1@2x.jpg" alt></div></a>
                                <div class="author"> <img src="pic/testimonial/author/1.jpg" data-at2x="pic/testimonial/author/1@2x.jpg" alt></div>
                            </div>
                            <!-- testimonial content-->
                            <div class="testimonial-body">
                                <h5 class="title"><span>Nicole</span> Beck</h5>
                                <div class="stars stars-5"></div>
                                <p class="align-center">Suspe blandit orci quis lorem eleifend maximus. Quisque nec.</p><a href="page-about-us.html" class="testimonial-button">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- testimonial item-->
                    <div class="col-md-4 col-sm-6 mb-md-30">
                        <div class="testimonial-item">
                            <div class="testimonial-top"><a href="hotels-details.html">
                                    <div class="pic"><img src="pic/testimonial/top-bg/2.jpg" data-at2x="pic/testimonial/top-bg/2@2x.jpg" alt></div></a>
                                <div class="author"> <img src="pic/testimonial/author/2.jpg" data-at2x="pic/testimonial/author/2@2x.jpg" alt></div>
                            </div>
                            <!-- testimonial content-->
                            <div class="testimonial-body">
                                <h5 class="title"><span>Peter</span> Robertson</h5>
                                <div class="stars stars-5"></div>
                                <p class="align-center">Nulla elit justo, dapibus ut lacus ac, ornare elementum neque.</p><a href="page-about-us.html" class="testimonial-button">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- testimonial item-->
                    <div class="col-md-4 col-sm-6">
                        <div class="testimonial-item">
                            <div class="testimonial-top"><a href="hotels-details.html">
                                    <div class="pic"><img src="pic/testimonial/top-bg/3.jpg" data-at2x="pic/testimonial/top-bg/3@2x.jpg" alt></div></a>
                                <div class="author"> <img src="pic/testimonial/author/3.jpg" data-at2x="pic/testimonial/author/3@2x.jpg" alt></div>
                            </div>
                            <!-- testimonial content-->
                            <div class="testimonial-body">
                                <h5 class="title"><span>Kathy</span> Harrison</h5>
                                <div class="stars stars-5"></div>
                                <p class="align-center">Maece facilisis sit amet mauris eget aliquam. Integer vitae.</p><a href="page-about-us.html" class="testimonial-button">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ! testimonials section-->
        <!-- team section-->
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="title-section-top font-4">Our team</h6>
                        <h2 class="title-section"><span>Work for</span> You</h2>
                        <div class="cws_divider mb-25 mt-5"></div>
                        <p>Fusce auctor vitae neque sed aliquam. Etiam augue nisl, tincidunt ut vestibulum ut, bibendum nec leo. Mauris facilisis magna efficitur tristique tempor. Sed a diam vitae nulla sagittis egestas.</p>
                    </div>
                </div>
                <div class="row profile-col">
                    <div class="col-md-4 col-sm-6 col-xs-6 mb-md-30">
                        <div class="profile-item">
                            <div class="profile-media"><img src="pic/team/1.jpg" data-at2x="pic/team/1@2x.jpg" alt></div>
                            <div class="title-wrap">
                                <h4 class="title"><span>Paul</span> Gaugin</h4>
                                <div class="positions"><a href="#" class="font-4">manager</a></div>
                            </div>
                            <div class="soc-links"><a href="#" class="cws-social fa fa-twitter"></a><a href="#" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"></a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6 mb-md-30">
                        <div class="profile-item">
                            <div class="profile-media"><img src="pic/team/2.jpg" data-at2x="pic/team/2@2x.jpg" alt></div>
                            <div class="title-wrap">
                                <h4 class="title"><span>Shirley</span> Mendoza</h4>
                                <div class="positions"><a href="#" class="font-4">support</a></div>
                            </div>
                            <div class="soc-links"><a href="#" class="cws-social fa fa-twitter"></a><a href="#" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"></a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="profile-item">
                            <div class="profile-media"><img src="pic/team/3.jpg" data-at2x="pic/team/3@2x.jpg" alt></div>
                            <div class="title-wrap">
                                <h4 class="title"><span>Joseph</span> Delgado</h4>
                                <div class="positions"><a href="#" class="font-4">Instructor</a></div>
                            </div>
                            <div class="soc-links"><a href="#" class="cws-social fa fa-twitter"></a><a href="#" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"> </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ! team section -->
        <!-- call out section-->
        <section class="page-section cws_prlx_section bg-white-80 pb-60 pt-60"><img src="pic/parallax-5.jpg" alt class="cws_prlx_layer">
            <div class="container">
                <div class="call-out-box">
                    <div class="call-out-wrap alt">
                        <h2 class="title-section alt-2 gray">Do you have questions?</h2><a href="#" class="cws-button border-left large alt mb-20">Contact us</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ! call out section-->
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
    <style>
    </style>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
    </script>
@endsection