@extends('layouts.frontend_2')

@section('body-content')
	<div class="tp-banner-container">
		<div class="tp-banner-slider">
			<ul>
				@foreach($home as $banner)
					<li data-masterspeed="700" data-slotamount="7" data-transition="fade">
						<img src="{{ URL::asset('frontend_images/'.$banner->image_path) }}"
							 data-lazyload="{{ URL::asset('frontend_images/'.$banner->image_path) }}" data-bgposition="center" alt="" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10">
						<div data-x="['center','center','center','center']" data-y="center" data-transform_in="x:-150px;opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:150px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="400" class="tp-caption sl-content">
							<div class="sl-title-top">{{$banner->content_1}}</div>
							<div class="sl-title">{{$banner->content_2}}</div>
							<div class="sl-title-bot">{{$banner->content_3}}</div>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
		<!-- slider info-->
		<div class="slider-info-wrap clearfix">
			<div class="slider-info-content">
				@foreach($packages as $package)
					<div class="slider-info-item">
						<div class="info-item-media"><img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
														  data-at2x="{{ URL::asset('storage/package_image/'.$package->featured_image) }}" alt>
							<div class="info-item-text">
								<div class="info-price font-4"><span>start from</span> Rp {{$package->price}}</div>
								{{--<div class="info-temp font-4"><span>local temperature</span> 36° / 96.8°</div>--}}
								<p class="info-text">{{$package->description}}</p>
							</div>
						</div>
						<div class="info-item-content">
							<div class="main-title">
								<h3 class="title"><span class="font-4">{{$package->province->name}}</span> {{$package->city->name}}</h3>
								<div class="price">start from <span>Rp {{$package->price}}</span></div>
								<a href="{{route('destination', ['key'=>$package->province_id])}}" class="button">Details</a>
							</div>
						</div>
					</div>
				@endforeach
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
				<a href="{{route('travelmate.index')}}">
					<div class="col-md-8">
						<h2 class="title-section alt-2"><span>HELLO</span></h2>
						<h6 class="title-section-top font-4">THIS IS OUR </h6>
						<h2 class="title-section alt-2"><span>TRAVEL</span></h2>
						<h2 class="title-section alt-2"><span>MATE</span></h2>
					</div>
				</a>
			</div>
			<div class="row" style="padding-bottom:15%;">
				<!-- testimonial carousel-->
				<div class="owl-three-item">

				@foreach($travelmates as $travelmate)
					<!-- testimonial item-->
						@php($star = "stars-".$travelmate->rating)
						<div class="testimonial-item">
							<div class="testimonial-top">
								<a href="#">
									<div class="pic">
										<img src="{{ URL::asset('storage/travelmate_banner/'.$travelmate->banner_picture) }}"
											 data-at2x="{{ URL::asset('storage/travelmate_banner/'.$travelmate->banner_picture) }}" alt>
									</div>
								</a>
								<div class="author">
									<img src="{{ URL::asset('storage/profile/'.$travelmate->profile_picture) }}"
										 data-at2x="{{ URL::asset('storage/profile/'.$travelmate->profile_picture) }}" alt>
								</div>
							</div>
							<!-- testimonial content-->
							<div class="testimonial-body">
								<h5 class="title"><span>{{$travelmate->first_name}}</span> {{$travelmate->last_name}}</h5>
								<div class="stars {{$star}}"></div>
								<p class="align-center">
									{{$travelmate->description}}
								</p><a href="#" class="testimonial-button">Visit Profile</a>
							</div>
						</div>
				@endforeach
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1" >
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="{{$video->link}}" class="embed-responsive-item"></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ! testimonials section-->

	@include('frontend.partials._modal-login')
@endsection