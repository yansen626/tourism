@extends('layouts.frontend')

@section('body-content')
    <!-- content-->
    <div class="content-body" style="background-image:url('{{ URL::asset('frontend_images/bg.jpg') }}');">
        <div class="container page">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <h2 class="title-section mb-5"><span>MAKE YOUR</span><br> OWN TRIP</h2>
                        <div class="search-hotels mb-40 pattern">
                            <div class="tours-container">
                                <div class="tours-box">
                                    <div class="">
                                        <div class="search-wrap col-md-6">
                                            <input type="text" placeholder="USERNAME" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                        </div>
                                        <div class="search-wrap col-md-6">
                                            <input type="text" placeholder="EMAIL" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                        </div>
                                        <div class="tours-calendar col-md-12">
                                            <input placeholder="DATE" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="calendar-default textbox-n"><i class="flaticon-suntour-calendar calendar-icon"></i>
                                        </div>
                                        <div class="search-wrap col-md-6">
                                            <input type="text" placeholder="DESTINATION" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                        </div>
                                        <div class="selection-box col-md-6"><i class="flaticon-suntour-adult box-icon"></i>
                                            <select>
                                                <option>Participant</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="selection-box col-md-12"><i class="flaticon-suntour-children box-icon"></i>
                                            <select>
                                                <option>Type Of Transport</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="search-wrap col-md-12">
                                            <input type="text" placeholder="BUDGET" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                        </div>
                                        <div class="search-wrap col-md-12">
                                            <input type="text" placeholder="REQUEST" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tours-search">
                                                <form method="post" class="form search">
                                                    <div class="search-wrap">
                                                        <input type="text" placeholder="Destination" class="form-control search-field"><i class="flaticon-suntour-map search-icon"></i>
                                                    </div>
                                                </form>
                                                <div class="button-search">Search</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="color:#ffffff;">
                    <!-- section title-->
                    <h2 class="title-section mt-0 mb-0">HELLO</h2>
                    <h4 class="title-section mt-0 mb-0">THIS IS</h4>
                    <h2 class="title-section mt-0 mb-0">TAILOR <br> MADE</h2>
                    <!-- ! section title-->
                    <div class="cws_divider with-plus short-3 mb-20 mt-10"></div>
                    <p class="mb-50">Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    <a href="#" class="cws-button alt">SUBMIT</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ! content-->


	@include('frontend.partials._modal-login')
@endsection