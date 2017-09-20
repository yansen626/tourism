@extends('layouts.frontend')

@section('body-content')


	<!-- HOME -->
	<section id="home" class="padbot0 margbot40">

		<!-- TOP SLIDER -->
		<div class="flexslider top_slider sale_page">
			<ul class="slides">
				@foreach($slideBanners as $slider)
				<li class="slide1">
					<div class="container" >
						<a href="{{ $slider->product_id ? 'product-detail/'. $slider->product_id:$slider->url }}">
							<div style="background-image: url('{{ asset('storage/banner/'. $slider->image_path) }}'); background-size: cover; height: 100%;">
								<div class="sale_caption1" >
									@if(!empty($slider->caption))
										<p class="title1 captionDelay2 FromTop" style="background-color: rgba(255, 255, 255, 0.5);">{{ $slider->caption }}</p>
									@endif
									@if(!empty($slider->sub_caption))
										<p class="title2 FromTop" style="background-color: rgba(255, 255, 255, 0.5);">{{ $slider->sub_caption }}</p>
									@endif
								</div>
							</div>
						</a>
					</div>
				</li>
				@endforeach
				{{--<li class="slide2">--}}

					{{--<!-- CONTAINER -->--}}
					{{--<div class="container">--}}
						{{--<div class="sale_caption1">--}}
							{{--<p class="title1 captionDelay2 FromTop">DRESS DAY</p>--}}
							{{--<p class="title2 FromTop">last week of sales</p>--}}
							{{--<a class="flex_btn" href="javascript:void(0);" >Buy now and get 25% discount</a>--}}
						{{--</div>--}}
					{{--</div><!-- //CONTAINER -->--}}
				{{--</li>--}}
			</ul>
		</div><!-- //TOP SLIDER -->
	</section><!-- //HOME -->


	<!-- TOVAR SECTION -->
	<section class="tovar_section">

		<!-- CONTAINER -->
		<div class="container">
			<h2>Featured products</h2>

			<!-- ROW -->
			<div class="row">

				<!-- TOVAR WRAPPER -->
				<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
				@for($i =0; $i< 3; $i++)
					<!-- TOVAR -->
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
							<div class="tovar_item">
								<div class="tovar_img">
									<div class="tovar_img_wrapper">
										<img class="img" src="{{ URL::asset('frontend_images/tovar/women/4.jpg') }}" alt="" />
										<img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/4_2.jpg') }}" alt="" />
									</div>
									<div class="tovar_item_btns">
										<a class="add_bag" href="#" onclick="addToCart('{{ $featuredProducts[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>
										{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
									</div>
								</div>
								<div class="tovar_description clearfix">
									<a class="tovar_title" href="{{ route('product-detail', ['id' => $featuredProducts[$i]->id]) }}" >{{ $featuredProducts[$i]->name }}</a>
									<span class="tovar_price">{{ $featuredProducts[$i]->price }}</span>
								</div>
							</div>
						</div><!-- //TOVAR4 -->
				@endfor

					<div class="respond_clear_768"></div>

					<!-- BANNER -->
					<div class="col-lg-3 col-md-3 col-xs-6 col-ss-12">

						@if(!empty($banner1st))
							<a class="banner type1 margbot30" href="{{ $banner1st->product_id ? 'product-detail/'. $banner1st->product_id:$banner1st->url }}" ><img src="{{ asset('storage/banner/'. $banner1st->image_path) }}" alt="" /></a>
						@else
							<a class="banner type1 margbot30" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner1.jpg') }}" alt="" /></a>
						@endif
						@if(!empty($banner2nd))
							<a class="banner type1 margbot30" href="{{ $banner2nd->product_id ? 'product-detail/'. $banner2nd->product_id:$banner2nd->url }}" ><img src="{{ asset('storage/banner/'. $banner2nd->image_path) }}" alt="" /></a>
						@else
							<a class="banner type2 margbot40" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner2.jpg') }}" alt="" /></a>
						@endif

					</div><!-- //BANNER -->
				</div><!-- //TOVAR WRAPPER -->
			</div><!-- //ROW -->


			<!-- ROW -->
			<div class="row">

				<!-- TOVAR WRAPPER -->
				<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>

					<div class="respond_clear_768"></div>
					@for($i =3; $i< 6; $i++)
						<!-- TOVAR -->
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
								<div class="tovar_item">
									<div class="tovar_img">
										<div class="tovar_img_wrapper">
											<img class="img" src="{{ URL::asset('frontend_images/tovar/women/4.jpg') }}" alt="" />
											<img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/4_2.jpg') }}" alt="" />
										</div>
										<div class="tovar_item_btns">
											<a class="add_bag" href="javascript:void(0);" onclick="addToCart('{{ $featuredProducts[$i]->id }}')" ><i class="fa fa-shopping-cart"></i></a>
											{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="{{ route('product-detail', ['id' => $featuredProducts[$i]->id]) }}" >{{ $featuredProducts[$i]->name }}</a>
										<span class="tovar_price">{{ $featuredProducts[$i]->price }}</span>
									</div>
								</div>
							</div><!-- //TOVAR4 -->
					@endfor

				</div><!-- //TOVAR WRAPPER -->
				<!-- BANNER -->
				<div class="col-lg-3 col-md-3 col-xs-6 col-ss-12">
					@if(!empty($banner3rd))
						<a class="banner type1 margbot30" href="{{ $banner3rd->product_id ? 'product-detail/'. $banner3rd->product_id:$banner3rd->url }}" ><img src="{{ asset('storage/banner/'. $banner3rd->image_path) }}" alt="" /></a>
					@else
						<a class="banner type3 margbot40" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner3.jpg') }}" alt="" /></a>
					@endif
				</div><!-- //BANNER -->
			</div><!-- //ROW -->


			<!-- ROW -->
			<div class="row">

				<!-- BANNER WRAPPER -->
				{{--<div class="banner_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>--}}
					{{--<!-- BANNER -->--}}
					{{--<div class="col-lg-9 col-md-9">--}}
						{{--<a class="banner type4 margbot40" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner4.jpg') }}" alt="" /></a>--}}
					{{--</div><!-- //BANNER -->--}}

					{{--<!-- BANNER -->--}}
					{{--<div class="col-lg-3 col-md-3">--}}
						{{--<a class="banner nobord margbot40" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner5.jpg') }}" alt="" /></a>--}}
					{{--</div><!-- //BANNER -->--}}
				{{--</div><!-- //BANNER WRAPPER -->--}}
			</div><!-- //ROW -->
		</div><!-- //CONTAINER -->
	</section><!-- //TOVAR SECTION -->


	<!-- NEW ARRIVALS -->
	<section class="new_arrivals padbot50">

		<!-- CONTAINER -->
		<div class="container">
			<h2>new arrivals</h2>

			<!-- JCAROUSEL -->
			<div class="jcarousel-wrapper">

				<!-- NAVIGATION -->
				<div class="jCarousel_pagination">
					<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
					<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
				</div><!-- //NAVIGATION -->

				<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>
					<ul>
						@foreach($recentProducts as $recentProduct)
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{ URL::asset('frontend_images/tovar/women/new/1.jpg') }}" alt="" />
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="{{ route('product-detail', ['id' => $recentProduct->id]) }}" >{{$recentProduct->name}}</a>
										<span class="tovar_price">Rp {{$recentProduct->price}}</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
						@endforeach
					</ul>
				</div>
			</div><!-- //JCAROUSEL -->
		</div><!-- //CONTAINER -->
	</section><!-- //NEW ARRIVALS -->


	<!-- BRANDS -->
	{{--<section class="brands_carousel">--}}

		{{--<!-- CONTAINER -->--}}
		{{--<div class="container">--}}

			{{--<!-- JCAROUSEL -->--}}
			{{--<div class="jcarousel-wrapper">--}}

				{{--<!-- NAVIGATION -->--}}
				{{--<div class="jCarousel_pagination">--}}
					{{--<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>--}}
					{{--<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>--}}
				{{--</div><!-- //NAVIGATION -->--}}

				{{--<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>--}}
					{{--<ul>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/1.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/2.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/3.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/4.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/5.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/6.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/7.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/8.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/9.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/10.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/11.jpg') }}" alt="" /></a></li>--}}
						{{--<li><a href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/brands/12.jpg') }}" alt="" /></a></li>--}}
					{{--</ul>--}}
				{{--</div>--}}
			{{--</div><!-- //JCAROUSEL -->--}}
		{{--</div><!-- //CONTAINER -->--}}
	{{--</section><!-- //BRANDS -->--}}

	<hr class="container">

	<script>
        var urlLink = '{{route('addCart')}}';
	</script>
	@include('frontend.partials._modal')
@endsection