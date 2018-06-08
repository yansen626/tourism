@extends('layouts.frontend')

@section('body-content')
	<div class="tp-banner-container">
		<div class="tp-banner-slider">
			<ul>
				<li data-masterspeed="700" data-slotamount="7" data-transition="fade"><img src="{{ URL::asset('frontend_images/bg1-1.jpg') }}" data-lazyload="{{ URL::asset('frontend_images/bg1-1.jpg') }}" data-bgposition="center" alt="" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10">
					<div data-x="['center','center','center','center']" data-y="center" data-transform_in="x:-150px;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:150px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="400" class="tp-caption sl-content">
						<div class="sl-title-top">Welcome to</div>
						<div class="sl-title">Honolulu</div>
						<div class="sl-title-bot">Starting <span>$105</span> per night</div>
					</div>
				</li>
				<li data-masterspeed="700" data-transition="fade"><img src="{{ URL::asset('frontend_images/bg1-2.jpg') }}" data-lazyload="{{ URL::asset('frontend_images/bg1-2.jpg') }}" data-bgposition="center" alt="" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10">
					<div data-x="['center','center','center','center']" data-y="center" data-transform_in="y:-150px;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:150px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="400" class="tp-caption sl-content">
						<div class="sl-title-top">Welcome to</div>
						<div class="sl-title">Istanbul</div>
						<div class="sl-title-bot">Starting <span>$255</span> per night</div>
					</div>
				</li>
				<li data-masterspeed="700" data-transition="fade"><img src="{{ URL::asset('frontend_images/bg1-3.jpg') }}" data-lazyload="{{ URL::asset('frontend_images/bg1-3.jpg') }}" data-bgposition="center" alt="" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10">
					<div data-x="['center','center','center','center']" data-y="center" data-transform_in="x:150px;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:-150px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="400" class="tp-caption sl-content">
						<div class="sl-title-top">Welcome to</div>
						<div class="sl-title">Dubai</div>
						<div class="sl-title-bot">Starting <span>$280</span> per night</div>
					</div>
				</li>
			</ul>
		</div>
		<!-- slider info-->
		<div class="slider-info-wrap clearfix">
			<div class="slider-info-content">
				<div class="slider-info-item">
					<div class="info-item-media"><img src="{{ URL::asset('frontend_images/top-slider-1.jpg') }}" data-at2x="{{ URL::asset('frontend_images/top-slider-1.jpg') }}" alt>
						<div class="info-item-text">
							<div class="info-price font-4"><span>start per night</span> $105</div>
							<div class="info-temp font-4"><span>local temperature</span> 36° / 96.8°</div>
							<p class="info-text">Nunc hendrerit nulla molestie ipsum tincidunt vestibulum. Nunc condimentum nibh.</p>
						</div>
					</div>
					<div class="info-item-content">
						<div class="main-title">
							<h3 class="title"><span class="font-4">Hawaii</span> Honolulu</h3>
							<div class="price"><span>$105</span> per night</div><a href="#" class="button">Details</a>
						</div>
					</div>
				</div>
				<div class="slider-info-item">
					<div class="info-item-media"><img src="{{ URL::asset('frontend_images/top-slider-2.jpg') }}" data-at2x="{{ URL::asset('frontend_images/top-slider-2.jpg') }}" alt>
						<div class="info-item-text">
							<div class="info-price font-4"><span>start per night</span> $55</div>
							<div class="info-temp font-4"><span>local temperature</span> 31° / 87.8°</div>
							<p class="info-text">Donec semper mattis diam sit amet eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et.</p>
						</div>
					</div>
					<div class="info-item-content">
						<div class="main-title">
							<h3 class="title"><span class="font-4">Turkey</span> Antalya</h3>
							<div class="price"><span>$55</span> per night</div><a href="#" class="button">Details</a>
						</div>
					</div>
				</div>
				<div class="slider-info-item">
					<div class="info-item-media"><img src="{{ URL::asset('frontend_images/top-slider-3.jpg') }}" data-at2x="{{ URL::asset('frontend_images/top-slider-3.jpg') }}" alt>
						<div class="info-item-text">
							<div class="info-price font-4"><span>start per night</span> $95</div>
							<div class="info-temp font-4"><span>local temperature</span> 41° / 105.8°</div>
							<p class="info-text">Donec ac eros dapibus, pulvinar enim in, vestibulum nisi. Sed bibendum magna at massa laoreet gravida.</p>
						</div>
					</div>
					<div class="info-item-content">
						<div class="main-title">
							<h3 class="title"><span class="font-4">Indonesia</span> Bali</h3>
							<div class="price"><span>$95</span> per night</div><a href="#" class="button">Details</a>
						</div>
					</div>
				</div>
				<div class="slider-info-item">
					<div class="info-item-media"><img src="{{ URL::asset('frontend_images/top-slider-4.jpg') }}" data-at2x="{{ URL::asset('frontend_images/top-slider-4.jpg') }}" alt>
						<div class="info-item-text">
							<div class="info-price font-4"><span>start per night</span> $80</div>
							<div class="info-temp font-4"><span>local temperature</span> 25° / 77°</div>
							<p class="info-text">Etiam malesuada lectus tempor, ultricies lectus in, convallis massa.</p>
						</div>
					</div>
					<div class="info-item-content">
						<div class="main-title">
							<h3 class="title"><span class="font-4">Austria</span> Serfaus</h3>
							<div class="price"><span>$80</span> per night</div><a href="#" class="button">Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ! slider-info-->
	</div>

	<!-- page section parallax-->
	<section class="small-section cws_prlx_section bg-gray-40"><img src="{{ URL::asset('frontend_images/bg2.jpg') }}" alt class="cws_prlx_layer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="map-wrapper">
						<iframe src="https://www.google.com/maps/d/u/0/embed?mid=148n8q25KFq6V4HJpI1v_7uedKzHgDDAs" allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ! page section parallax-->

	<!-- testimonials section-->
	<section class="small-section cws_prlx_section bg-blue-40"><img src="{{ URL::asset('frontend_images/bg3.jpg') }}" alt class="cws_prlx_layer">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2 class="title-section alt-2"><span>HELLO</span></h2>
					<h6 class="title-section-top font-4">THIS IS OUR </h6>
					<h2 class="title-section alt-2"><span>TRAVEL</span></h2>
					<h2 class="title-section alt-2"><span>MATE</span></h2>
				</div>
			</div>
			<div class="row" style="padding-bottom:15%;">
				<!-- testimonial carousel-->
				<div class="owl-three-item">
					<!-- testimonial item-->
					<div class="testimonial-item">
						<div class="testimonial-top"><a href="#">
								<div class="pic"><img src="{{ URL::asset('storage/banner_profile/banner-1.jpg') }}" data-at2x="{{ URL::asset('storage/banner_profile/banner-1.jpg') }}" alt></div></a>
							<div class="author"> <img src="{{ URL::asset('storage/profile/profile1.jpg') }}" data-at2x="{{ URL::asset('storage/profile/profile1.jpg') }}" alt></div>
						</div>
						<!-- testimonial content-->
						<div class="testimonial-body">
							<h5 class="title"><span>Nicole</span> Beck</h5>
							<div class="stars stars-5"></div>
							<p class="align-center">Suspe blandit orci quis lorem eleifend maximus. Quisque nec.</p><a href="#" class="testimonial-button">Visit Profile</a>
						</div>
					</div>
					<!-- testimonial item-->
					<div class="testimonial-item">
						<div class="testimonial-top"><a href="#">
                            <div class="pic"><img src="{{ URL::asset('storage/banner_profile/banner-2.jpg') }}" data-at2x="{{ URL::asset('storage/banner_profile/banner-2.jpg') }}" alt></div></a>
							<div class="author"> <img src="{{ URL::asset('storage/profile/profile2.jpg') }}" data-at2x="{{ URL::asset('storage/profile/profile2.jpg') }}" alt></div>
						</div>
						<!-- testimonial content-->
						<div class="testimonial-body">
							<h5 class="title"><span>Peter</span> Robertson</h5>
							<div class="stars stars-5"></div>
							<p class="align-center">Nulla elit justo, dapibus ut lacus ac, ornare elementum neque.</p><a href="#" class="testimonial-button">Visit Profile</a>
						</div>
					</div>
					<!-- testimonial item-->
					<div class="testimonial-item">
						<div class="testimonial-top"><a href="#">
								<div class="pic"><img src="{{ URL::asset('storage/banner_profile/banner-3.jpg') }}" data-at2x="{{ URL::asset('storage/banner_profile/banner-3.jpg') }}" alt></div></a>
                                <div class="author"> <img src="{{ URL::asset('storage/profile/profile3.jpg') }}" data-at2x="{{ URL::asset('storage/profile/profile3.jpg') }}" alt></div>
						</div>
						<!-- testimonial content-->
						<div class="testimonial-body">
							<h5 class="title"><span>Kathy</span> Harrison</h5>
							<div class="stars stars-5"></div>
							<p class="align-center">Maece facilisis sit amet mauris eget aliquam. Integer vitae.</p><a href="#" class="testimonial-button">Visit Profile</a>
						</div>
					</div>
					<!-- testimonial item-->
					<div class="testimonial-item">
						<div class="testimonial-top"><a href="#">
								<div class="pic"><img src="{{ URL::asset('storage/banner_profile/banner-4.jpg') }}" data-at2x="{{ URL::asset('storage/banner_profile/banner-4.jpg') }}" alt></div></a>
							<div class="author"> <img src="{{ URL::asset('storage/profile/profile4.jpg') }}" data-at2x="{{ URL::asset('storage/profile/profile4.jpg') }}" alt></div>
						</div>
						<!-- testimonial content-->
						<div class="testimonial-body">
							<h5 class="title"><span>Nicky</span> Beck</h5>
							<div class="stars stars-5"></div>
							<p class="align-center">Suspe blandit orci quis lorem eleifend maximus. Quisque nec.</p><a href="#" class="testimonial-button">Visit Profile</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1" >
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="https://www.youtube.com/embed/ojQbArbuN4E" class="embed-responsive-item"></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ! testimonials section-->

	@include('frontend.partials._modal-login')
@endsection