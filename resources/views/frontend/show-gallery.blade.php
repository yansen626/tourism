@extends('layouts.frontend-gallery')

@section('body-content')

<section class="breadcrumb margbot10"></section>

<!-- TOVAR DETAILS -->
<section class="tovar_details padbot70">

    <!-- CONTAINER -->
    <div class="container">

        <!-- ROW -->
        <div class="row">

            <!-- TOVAR DETAILS WRAPPER -->
            <div class="col-lg-12 col-md-12 tovar_details_wrapper clearfix">
                <div class="tovar_details_header clearfix margbot10">
                    <div id="wowslider-container1">
                        <div class="ws_images"><ul>
                                @php( $idx = 0 )
                                @foreach($images as $image)
                                    <li><img src="{{ asset('storage/gallery/'. $image->file_name) }}" alt="{{ 'pict_'. $idx }}" id="{{ 'wowsl_'. $idx }}"/></li>
                                    @php( $idx++ )
                                @endforeach
                                {{--<li><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_2" title="cat_example_2" id="wows1_0"/></li>--}}
                                {{--<li><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_3" title="cat_example_3" id="wows1_1"/></li>--}}
                                {{--<li><a href="http://wowslider.net"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="bootstrap slider" title="cat_example_4" id="wows1_2"/></a></li>--}}
                                {{--<li><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_5" title="cat_example_5" id="wows1_3"/></li>--}}
                            </ul></div>
                        <div class="ws_thumbs">
                            <div>
                                @php( $idx = 0 )
                                @foreach($images as $image)
                                    <a href="#"><img src="{{ asset('storage/gallery/'. $image->file_name) }}" alt="" /></a>
                                    @php( $idx++ )
                                @endforeach
                                {{--<a href="#" title="cat_example_2"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" /></a>--}}
                                {{--<a href="#" title="cat_example_3"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" /></a>--}}
                                {{--<a href="#" title="cat_example_4"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" /></a>--}}
                                {{--<a href="#" title="cat_example_5"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" /></a>--}}
                            </div>
                        </div>
                        <div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">css slideshow</a> by WOWSlider.com v8.8</div>
                        <div class="ws_shadow"></div>
                    </div>
                </div>
                <div class="tovar_details_header clearfix margbot10" style="text-align: center;">
                    <div id="vlightbox1">
                        @php( $idx = 0 )
                        @foreach($images as $image)
                            {{--<a href="#"><img src="{{ asset('storage/gallery/'. $image->file_name) }}" alt="" /></a>--}}
                            <a class="vlightbox1" href="{{ asset('storage/gallery/'. $image->file_name) }}"><img src="{{ asset('storage/gallery/'. $image->file_name) }}" alt="{{ 'pict_'. $idx }}"/></a>
                            @php( $idx++ )
                        @endforeach
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="cat_example_2"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_2"/></a>--}}
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="cat_example_3"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_3"/></a>--}}
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="cat_example_4"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_4"/></a>--}}
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="cat_example_5"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="cat_example_5"/></a>--}}
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="banner-1"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="banner-1"/></a>--}}
                        {{--<a class="vlightbox1" href="{{ asset('frontend_images/tovar/banner17.jpg') }}" title="banner-2"><img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="banner-2"/></a>--}}
                    </div>
                </div>
            </div><!-- //TOVAR DETAILS WRAPPER -->
        </div><!-- //ROW -->
    </div><!-- //CONTAINER -->
</section><!-- //TOVAR DETAILS -->


<hr class="container">
<script>
    var urlLink = '{{route('addCart')}}';
</script>
@include('frontend.partials._modal')
@endsection


