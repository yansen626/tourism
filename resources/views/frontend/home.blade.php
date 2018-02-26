@extends('layouts.frontend')

@section('body-content')

	<!-- BANNER SECTION -->
	<section class="banner_section" style="margin-top: 10px">
		<!-- CONTAINER -->
		<div class="container">

			<!-- ROW -->
			<div class="row">
				<div class="top_sale_banners center">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-ss-12">
						@if(!empty($banner1st))
							@if(!empty($banner1st->gallery_id))
								<a class="banner nobord margbot10" href="{{ route('frontend-gallery-show', ['id' => $banner1st->gallery_id]) }}" >
									@if(!empty($banner1st->image_path))
										<img src="{{ asset('storage/banner/'. $banner1st->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@else
								<a class="banner nobord margbot10" href="{{ 'http://'. $banner1st->url }}" >
									@if(!empty($banner1st->image_path))
										<img src="{{ asset('storage/banner/'. $banner1st->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@endif
						@else
							<a class="banner nobord margbot10" href="#" >
								<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
							</a>
						@endif

					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-ss-12">

						@if(!empty($banner2nd))
							@if(!empty($banner2nd->gallery_id))
								<a class="banner nobord margbot10" href="{{ route('frontend-gallery-show', ['id' => $banner2nd->gallery_id]) }}" >
									@if(!empty($banner2nd->image_path))
										<img src="{{ asset('storage/banner/'. $banner2nd->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@else
								<a class="banner nobord margbot10" href="{{ 'http://'. $banner2nd->url }}" >
									@if(!empty($banner2nd->image_path))
										<img src="{{ asset('storage/banner/'. $banner2nd->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@endif
						@else
							<a class="banner nobord margbot10" href="#" >
								<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
							</a>
						@endif

					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-ss-12">

						@if(!empty($banner3rd))
							@if(!empty($banner3rd->gallery_id))
								<a class="banner nobord margbot10" href="{{ route('frontend-gallery-show', ['id' => $banner3rd->gallery_id]) }}" >
									@if(!empty($banner3rd->image_path))
										<img src="{{ asset('storage/banner/'. $banner3rd->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@else
								<a class="banner nobord margbot10" href="{{ 'http://'. $banner3rd->url }}" >
									@if(!empty($banner3rd->image_path))
										<img src="{{ asset('storage/banner/'. $banner3rd->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@endif
						@else
							<a class="banner nobord margbot10" href="#" >
								<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
							</a>
						@endif

					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-ss-12">

						@if(!empty($banner4th))
							@if(!empty($banner4th->gallery_id))
								<a class="banner nobord margbot10" href="{{ route('frontend-gallery-show', ['id' => $banner4th->gallery_id]) }}" >
									@if(!empty($banner4th->image_path))
										<img src="{{ asset('storage/banner/'. $banner4th->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@else
								<a class="banner nobord margbot10" href="{{ 'http://'. $banner4th->url }}" >
									@if(!empty($banner4th->image_path))
										<img src="{{ asset('storage/banner/'. $banner4th->image_path) }}" alt="" style="border-radius: 3px;"/>
									@else
										<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
									@endif
								</a>
							@endif
						@else
							<a class="banner nobord margbot10" href="#" >
								<img src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" style="border-radius: 3px;"/>
							</a>
						@endif

					</div>
				</div>
			</div><!-- //ROW -->
		</div><!-- //CONTAINER -->
	</section><!-- //BANNER SECTION -->

	<!-- HOME -->
	<section id="home" class="padbot0" style="margin-top: 10px;">

		<!-- TOP FIRST SLIDER -->
		{{--<div class="flexslider top_slider sale_page first_banner" style="margin-bottom: 10px;">--}}
			{{--<ul class="slides">--}}
				{{--@foreach($topBanner1st as $slider)--}}
				{{--<li class="slide1">--}}
					{{--<div class="container" >--}}
						{{--<a href="{{ $slider->product_id ? 'product-detail/'. $slider->product_id : 'http://'. $slider->url }}">--}}
							{{--<div style="background-image: url('{{ asset('storage/banner/'. $slider->image_path) }}'); background-size: cover; height: 100%; border-radius: 5px;">--}}
								{{--<div class="sale_caption1" >--}}
									{{--@if(!empty($slider->caption))--}}
										{{--<p class="title1 captionDelay2 FromTop" style="background-color: rgba(255, 255, 255, 0.5);">{{ $slider->caption }}</p>--}}
									{{--@endif--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</a>--}}
					{{--</div>--}}
				{{--</li>--}}
				{{--@endforeach--}}
			{{--</ul>--}}
		{{--</div>--}}
	<!-- TOP SECOND SLIDER -->
		<div class="flexslider top_slider sale_page second_banner">
			<ul class="slides">
				@foreach($sliderBanners as $slider)
					<?php
						$bannerUrl = "";
						if(!empty($slider->product_id) && empty($slider->gallery_id)){
						    $bannerUrl = route('product-detail', ['id' => $slider->product_id]);
						}
						elseif(empty($slider->product_id) && !empty($slider->gallery_id)){
                            $bannerUrl = route('frontend-gallery-show', ['id' => $slider->gallery_id]);
						}
						else{
                            $bannerUrl = 'http://'. $slider->url;
						}
					?>
					<li class="slide1">
						<div class="container" >
							<a href="{{ $bannerUrl }}">
								<div class="slider_background_image" style="background-image: url('{{ asset('storage/banner/'. $slider->image_path) }}');">
									<div class="sale_caption1" >
										@if(!empty($slider->caption))
											<p class="title1 captionDelay2 FromTop" style="background-color: rgba(255, 255, 255, 0.5);">{{ $slider->caption }}</p>
										@endif
									</div>
								</div>
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
		<!-- //TOP SECOND SLIDER -->

	</section><!-- //HOME -->

	<!-- TOVAR SECTION -->
	<section class="tovar_section desktop">

		<!-- CONTAINER -->
		<div class="container">
			<hr>
			<h2>FEATURED</h2>

			<!-- ROW -->
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 3, 'categoryName' => 'Perisa' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/perisa.png') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Perisa</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat1Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat1Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat1Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat1Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat1Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat1Products[$i]->id]) }}" class="category_item_title">{{ $cat1Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat1Products[$i]))
														@if(!empty($cat1Products[$i]->discount) || !empty($cat1Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat1Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat1Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat1Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat1Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 8, 'categoryName' => 'Butter' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/butter.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Butter</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">

													@if(!empty($cat2Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat2Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat2Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat2Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat2Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat2Products[$i]->id]) }}" class="category_item_title">{{ $cat2Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat2Products[$i]))
														@if(!empty($cat2Products[$i]->discount) || !empty($cat2Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat2Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat2Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat2Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat2Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 13, 'categoryName' => 'Chocolate' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/chocolate.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Chocolate</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat3Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat3Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat3Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat3Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat3Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat3Products[$i]->id]) }}" class="category_item_title">{{ $cat3Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat3Products[$i]))
														@if(!empty($cat3Products[$i]->discount) || !empty($cat3Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat3Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat3Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat3Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat3Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 4, 'categoryName' => 'Flavor' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/essence.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Flavor</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat4Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat4Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat4Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat4Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat4Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat4Products[$i]->id]) }}" class="category_item_title">{{ $cat4Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat4Products[$i]))
														@if(!empty($cat4Products[$i]->discount) || !empty($cat4Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat4Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat4Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat4Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat4Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 1, 'categoryName' => 'Tools' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/tools.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Tools</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">

													@if(!empty($cat5Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat5Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat5Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat5Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat5Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat5Products[$i]->id]) }}" class="category_item_title">{{ $cat5Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat5Products[$i]))
														@if(!empty($cat5Products[$i]->discount) || !empty($cat5Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat5Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat5Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat5Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat5Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 19, 'categoryName' => 'Utensil' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/utensil.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Utensil</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">

													@if(!empty($cat6Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat6Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat6Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat6Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat6Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat6Products[$i]->id]) }}" class="category_item_title">{{ $cat6Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat6Products[$i]))
														@if(!empty($cat6Products[$i]->discount) || !empty($cat6Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat6Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat6Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat6Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat6Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 23, 'categoryName' => 'Loyang' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/loyang.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Loyang</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat7Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat7Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat7Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat7Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat7Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat7Products[$i]->id]) }}" class="category_item_title">{{ $cat7Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat7Products[$i]))
														@if(!empty($cat7Products[$i]->discount) || !empty($cat7Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat1Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat7Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat7Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat7Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 12, 'categoryName' => 'Gula' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/gula.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Gula</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat8Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat8Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat8Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat8Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat8Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat8Products[$i]->id]) }}" class="category_item_title">{{ $cat8Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat8Products[$i]))
														@if(!empty($cat8Products[$i]->discount) || !empty($cat8Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat8Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat8Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat8Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat8Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<div class="row margbot10">
				<div class="col-lg-3 col-md-3 col-sm-12" style="padding-right: 0;">
					<a href="{{ route('products', ['categoryId' => 25, 'categoryName' => 'Dus' ]) }}">
						<div class="category_img" style="background-image: url('{{ asset('frontend_images/category/dus.jpg') }}')" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<div class="category_img_title">
								<span>Dus</span>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12" style="padding-left: 0;">
					<div class="category_wrapper">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							@for($i =0; $i< 4; $i++)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12">
									<div class="category_product_wrapper">
										<div class="tovar_item">
											<div class="tovar_img">
												<div class="tovar_img_wrapper">
													@if(!empty($cat9Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat9Products[$i]->id]) }}">
															<img style="height: 191px;" class="img" src="{{ asset('storage/product/'. $cat9Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
															<img style="height: 191px;" class="img_h" src="{{ asset('storage/product/'. $cat9Products[$i]->product_image()->where('featured', 1)->first()->path) }}" alt="" />
														</a>
													@else
														<img style="height: 191px;" class="img" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
														<img style="height: 191px;" class="img_h" src="{{ asset('frontend_images/tovar/banner17.jpg') }}" alt="" />
													@endif
												</div>
												<div class="tovar_item_btns">
													{{--<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>--}}
													@if(!empty($cat9Products[$i]))
														<a href="{{ route('product-detail', ['id' => $cat9Products[$i]->id]) }}" class="category_item_title">{{ $cat9Products[$i]->name }}</a><br/>
													@endif

													@if(!empty($cat9Products[$i]))
														@if(!empty($cat9Products[$i]->discount) || !empty($cat9Products[$i]->discount_flat))
															<span class="price-number" style="text-decoration: line-through;">Rp {{ $cat9Products[$i]->price }}</span><br/>
															<span class="price-number"><b>Rp {{ $cat9Products[$i]->price_discounted }}</b></span><br/>
														@else
															<span class="price-number"><b>Rp {{ $cat9Products[$i]->price_discounted }}</b></span><br/>
														@endif
														{{--<a class="add_bag" href="#" onclick="addToCart('{{ $cat9Products[$i]->id }}'); return false;"><i class="fa fa-shopping-cart"></i></a>--}}
													@else
														<a href="#" class="category_item_title">Product Name Here</a><br/>
														<span style="text-decoration: line-through;">Rp 50.000</span><br/>
														<span style="color:orange;"><b>Rp 90.000</b></span><br/>
														{{--<a class="add_bag" href="#"><i class="fa fa-shopping-cart"></i></a>--}}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<!-- //ROW -->
		</div><!-- //CONTAINER -->
	</section><!-- //TOVAR SECTION -->


	<!-- NEW ARRIVALS -->
	<section class="new_arrivals">

		<!-- CONTAINER -->
		<div class="container">
			<hr>
			<h2>Produk Terbaru</h2>

			<!-- JCAROUSEL -->
			<div class="jcarousel-wrapper">

				<!-- NAVIGATION -->
				<div class="jCarousel_pagination">
					<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
					<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
				</div><!-- //NAVIGATION -->

				<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>
					<ul>
						@foreach($recentProducts as $recProduct)
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<a href="{{ route('product-detail', ['id' => $recProduct->id]) }}" >
											<img src="{{ URL::asset('storage/product/'. $recProduct->product_image()->where('featured', 1)->first()->path) }}" alt="" />
										</a>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="{{ route('product-detail', ['id' => $recProduct->id]) }}" >{{$recProduct->name}}</a>
										@if(!empty($recProduct->discount) || !empty($recProduct->discount_flat))
											<span style="text-decoration: line-through;">Rp {{ $recProduct->price }}</span><br/>
											<p style="color:orange;"><b>Rp {{ $recProduct->price_discounted }}</b></p>
										@else
											<span class="tovar_price">Rp {{$recProduct->price}}</span>
										@endif
									</div>
								</div><!-- //TOVAR -->
							</li>
						@endforeach
					</ul>
				</div>
			</div><!-- //JCAROUSEL -->
		</div><!-- //CONTAINER -->
	</section><!-- //NEW ARRIVALS -->

	<section>
		<div class="container">
			<hr>
			<h2>Kategori</h2>

			<div class="list-group category_home_menu category_first_column">
				@for($i = 0; $i < $firstColumn; $i++)
					@if($i % 2 == 1)
						<a href="{{ route('products', ['categoryId' => $categories[$i]->id, 'categoryName' => $categories[$i]->name]) }}" class="list-group-item odd">
							<div class="inner_category_list">
								{{ $categories[$i]->name }}
							</div>
						</a>
					@else
						<a href="{{ route('products', ['categoryId' => $categories[$i]->id, 'categoryName' => $categories[$i]->name]) }}" class="list-group-item even">
							<div class="inner_category_list">
								{{ $categories[$i]->name }}
							</div>
						</a>
					@endif
				@endfor
				{{--<a href="#" class="list-group-item">--}}
					{{--<span class="glyphicon glyphicon-film"></span> Videos--}}
				{{--</a>--}}
			</div>
			<div class="list-group category_home_menu category_second_column">
				@php( $idx = 0 )
				@for($i = ($categoryTotal - $firstColumn) + 1; $i < $categoryTotal; $i++)
					@if($idx % 2 == 1)
						<a href="{{ route('products', ['categoryId' => $categories[$i]->id, 'categoryName' => $categories[$i]->name]) }}" class="list-group-item odd">
							<div class="inner_category_list">
								{{ $categories[$i]->name }}
							</div>
						</a>
					@else
						<a href="{{ route('products', ['categoryId' => $categories[$i]->id, 'categoryName' => $categories[$i]->name]) }}" class="list-group-item even">
							<div class="inner_category_list">
								{{ $categories[$i]->name }}
							</div>
						</a>
					@endif
					@php( $idx++ )
				@endfor
			</div>
		</div>
	</section>


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
	<script>
        var urlLink = '{{route('addCart')}}';
	</script>
	@include('frontend.partials._modal')
@endsection