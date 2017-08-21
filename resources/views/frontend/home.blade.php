@extends('layouts.frontend')

@section('body')
	<!-- Slider-Section-Strat  -->
	<div class="slider_area">
		<div class="fullwidthbanner">
			<ul>
				<!-- SLIDE-1  -->
				<li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
					<!-- MAIN IMAGE -->
					<img src="{{ URL::asset('frontend_images/slider/slider_bg-2.jpg') }}"  alt="mainbanner-31"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption banner1 tp-fade tp-resizeme"
						data-x="910"
						data-y="20"
						data-speed="300"
						data-start="500"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						data-end="8700"
						data-endspeed="300"
						style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;"><img src="{{ URL::asset('frontend_images/slider/slide-2.png') }}" alt="">
					</div>

					<!-- LAYER NR. 2 -->
					<div class="tp-caption banner12 tp-fade tp-resizeme"
						 data-x="385"
						 data-y="145"
						data-speed="300"
						data-start="800"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 7;font-size:72px; font-family:nexa_blackregular;font-weight:700;color:#3a4b60;max-width: auto; max-height: auto; white-space: nowrap;">ELIXIR T-08
					</div>

					<!-- LAYER NR. 3 -->
					<div class="tp-caption banner13 tp-fade tp-resizeme"
						data-x="385"
						data-y="190"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:24px;line-height:26px;font-family:Roboto;font-weight:100; color:#ffffff;letter-spacing:8px;">FEELING YOUR IMAGINTION
					</div>

					<!-- LAYER NR. 4.1 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="273"
						data-speed="300"
						data-start="800"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						100% COMBED COTTON
					</div>

					<!-- LAYER NR. 4.2 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="309"
						data-speed="300"
						data-start="1000"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"

						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						COLOR: BLUE
					</div>

					<!-- LAYER NR. 4.3 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="345"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						ROUND NECK & HALF SLEEVES
					</div>

					<!-- LAYER NR. 4.4 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="381"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"

						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						CLASSIC FIT, SLIGHTLY LONG
					</div>

					<!-- LAYER NR. 4.5 -->
					<div class="tp-caption banner22 tp-fade tp-resizeme"
						data-x="385"
						data-y="418"
						data-speed="300"
						data-start="1400"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						GSM: 160
					</div>

					<!-- LAYER NR. 4.6 -->
					<div class="tp-caption banner23 tp-fade tp-resizeme"
						data-x="385"
						data-y="450"
						data-speed="300"
						data-start="1700"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">PRICE: $ 29.99
					</div>

					<!-- LAYER NR. 4.7 -->
					<div class="tp-caption banner2 tp-fade tp-resizeme"
						data-x="385"
						data-y="530"
						data-speed="300"
						data-start="1800"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						>
						<a class="slide_btn" href="#" style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;font-size:16px; color:#fff;border: 2px solid #ffffff;line-height:2;padding: 10px 30px;">SHOP NOW</a>
					</div>
				</li>
				<!-- SLIDE-2 -->
				<li data-transition="random" data-slotamount="7" data-masterspeed="300" data-title="Slide2" data-saveperformance="off" >
					<!-- MAIN IMAGE -->
					<img src="{{ URL::asset('frontend_images/slider/slider_bg-1.jpg') }}"  alt="mainbanner-21"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption tp-fade"
						data-x="910"
						data-y="20"
						data-speed="300"
						data-start="800"
						data-easing="Power3.easeInOut"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 3;"><img src="{{ URL::asset('frontend_images/slider/slide-1.png') }}" alt="">
					</div>

					<!-- LAYER NR. 2 -->
					<div class="tp-caption banner12 tp-fade tp-resizeme"
						 data-x="385"
						 data-y="145"
						data-speed="300"
						data-start="800"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 7;font-size:72px; font-family:nexa_blackregular;font-weight:700;color:#3a4b60;max-width: auto; max-height: auto; white-space: nowrap;">ELIXIR T-08
					</div>

					<!-- LAYER NR. 3 -->
					<div class="tp-caption banner13 tp-fade tp-resizeme"
						data-x="385"
						data-y="190"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:24px;line-height:26px;font-family:Roboto;font-weight:100; color:#ffffff;letter-spacing:8px;">FEELING YOUR IMAGINTION
					</div>

					<!-- LAYER NR. 4.1 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="273"
						data-speed="300"
						data-start="800"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						100% COMBED COTTON
					</div>

					<!-- LAYER NR. 4.2 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="309"
						data-speed="300"
						data-start="1000"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						COLOR: GRAY BLACK
					</div>

					<!-- LAYER NR. 4.3 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="345"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						ROUND NECK & HALF SLEEVES
					</div>

					<!-- LAYER NR. 4.4 -->
					<div class="tp-caption banner21 tp-fade tp-resizeme"
						data-x="385"
						data-y="381"
						data-speed="300"
						data-start="1100"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						CLASSIC FIT, SLIGHTLY LONG
					</div>

					<!-- LAYER NR. 4.5 -->
					<div class="tp-caption banner22 tp-fade tp-resizeme"
						data-x="385"
						data-y="418"
						data-speed="300"
						data-start="1400"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">
						GSM: 180
					</div>

					<!-- LAYER NR. 4.6 -->
					<div class="tp-caption banner23 tp-fade tp-resizeme"
						data-x="385"
						data-y="450"
						data-speed="300"
						data-start="1700"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;font-size:20px;line-height:2;font-family:nexa_bookregular;color:#ffffff;">PRICE: $ 35.99
					</div>

					<!-- LAYER NR. 4.7 -->
					<div class="tp-caption banner2 tp-fade tp-resizeme"
						data-x="385"
						data-y="530"
						data-speed="1800"
						data-start="500"
						data-easing="Power3.easeInOut"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0"
						data-endelementdelay="0"
						 data-end="8700"
						data-endspeed="300"
						>
						<a class="slide_btn" href="#" style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;font-size:16px; color:#fff;border: 2px solid #ffffff;line-height:2;padding: 10px 30px;">SHOP NOW</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- Slider-Section-End  -->
	<!-- Product-Section-Strat  -->
	<section class="product_area section-padding">
		<div class="padding_right main_single_product">
			<div class="single_product">
				<div class="product_img">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-1.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text dark_product">
					<h1>DARK BLUE</h1>
				</div>
			</div>
		</div>
		<div class="padding_left main_single_product">
			<div class="single_product single_product_two">
				<div class="product_img">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-1.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text_two product_text">
					<h1>MEN'S TEE</h1>
					<p>100% COMBED COTTON</p>
					<p>COLOR: DARK BLUE</p>
					<p>ROUND NECK & HALF SLEEVES</p>
					<p>Classic fit, slightly long</p>
					<p>GSM: 180</p>
					<p>PRICE: $ 21.99</p>
					<a class="shop_now_btn" href="#">SHOP NOW</a>
				</div>
			</div>
		</div>
		<div class="padding_right main_single_product section-padding-top">
			<div class="single_product single_product_two">
				<div class="product_img tre_shirt_2">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-2.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text_two tre_shirt_2_text product_text">
					<h1>MEN'S TEE</h1>
					<p>100% COMBED COTTON</p>
					<p>COLOR: WHITE & BLACK</p>
					<p>ROUND NECK & HALF SLEEVES</p>
					<p>Classic fit, slightly long</p>
					<p>GSM: 180</p>
					<p>PRICE: $ 21.99</p>
					<a class="shop_now_btn" href="#">SHOP NOW</a>
				</div>
			</div>
		</div>
		<div class="padding_left main_single_product section-padding-top">
			<div class="single_product">
				<div class="product_img tre_shirt_2">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-2.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text dark_product">
					<h1>WHITE & BLACK</h1>
				</div>
			</div>
		</div>
		<div class="padding_right main_single_product section-padding-top">
			<div class="single_product">
				<div class="product_img tre_shirt_3">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-3.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text dark_product">
					<h1>GRAY WITH BLACK</h1>
				</div>
			</div>
		</div>
		<div class="padding_left main_single_product section-padding-top">
			<div class="single_product single_product_two">
				<div class="product_img tre_shirt_3">
					<img src="{{ URL::asset('frontend_images/product/tre-shirt-3.png') }}" alt="DARK BLUE IMAGE" />
				</div>
				<div class="product_text_two product_text">
					<h1>LADIES TEE</h1>
					<p>100% COMBED COTTON</p>
					<p>COLOR: GRAY WITH BLACK</p>
					<p>ROUND NECK & HALF SLEEVES</p>
					<p>Classic fit, slightly long</p>
					<p>GSM: 180</p>
					<p>PRICE: $ 31.99</p>
					<a class="shop_now_btn" href="#">SHOP NOW</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Product-Section-End  -->
	<!-- Choose-Section-Strat  -->
	<section class="choose_area section-padding">
		<div class="container">
			<div class="choose_area_text text-center">
				<div class="choose_title">
				<h2>WHY CHOOSE OUR TEES ?</h2>
				</div>
				<div class="choose_text">
					<i class="flaticon-lightbulbs"></i>
					<h5><a href="#">UNIQUE DESIGN</a></h5>
					<div class="text_p">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
					</div>
				</div>
				<div class="choose_text choose_active">
					<i class="flaticon-sticker3"></i>
					<h5><a href="#">best quality</a></h5>
					<div class="text_p">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
					</div>
				</div>
				<div class="choose_text">
					<i class="flaticon-tshirt17"></i>
					<h5><a href="#">COMFORTABLE TEES</a></h5>
					<div class="text_p">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
					</div>
				</div>
			</div>
			<div class="choose_btn text-center">
				<a class="shop_now_btn" href="#">SHOP NOW</a>
			</div>
		</div>
	</section>
	<!-- Choose-Section-End  -->
	<!-- Review-Section-Strat  -->
	<section class="review_area section-padding">
		<div class="container">
			<div class="review_text text-center">
				<div class="review_title">
					<h2>CUSTOMER REVIEW</h2>
				</div>
				<div id="review_carousel_1" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators slider_indicators">
						<li data-target="#review_carousel_1" data-slide-to="0" class="active"></li>
						<li data-target="#review_carousel_1" data-slide-to="1"></li>
						<li data-target="#review_carousel_1" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<div class="single_review">
								<img src="{{ URL::asset('frontend_images/review/person1.jpg') }}" alt="" />
								<h5><a href="#">Michelle Wilson</a></h5>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's</p>
								<div class="review_line"></div>
								<div class="review_icon">
									<i>“</i>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="single_review">
								<img src="{{ URL::asset('frontend_images/review/person2.jpg') }}" alt="" />
								<h5><a href="#">Michelle Wilson</a></h5>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's</p>
								<div class="review_line"></div>
								<div class="review_icon">
									<i>“</i>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="single_review">
								<img src="{{ URL::asset('frontend_images/review/person3.jpg') }}" alt="" />
								<h5><a href="#">Michelle Wilson</a></h5>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's</p>
								<div class="review_line"></div>
								<div class="review_icon">
									<i>“</i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Review-Section-End  -->
	<!-- Compare-Section-Strat  -->
	<section class="compare_area section-padding">
		<div class="container">
			<div class="review_text text-center">
				<div class="compare_title">
					<h2>COMPARE OUR PRODUCTS</h2>
					<p>CPMPARE OUR PRODUCTS AND CHOOSE THE BEST ONE FOR YOURS</p>
				</div>
				<div class="compare_menu col-text-center">
					<ul class="nav nav-tabs items_ul" role="tablist" id="myTab">
					  <li role="presentation"><a href="#features" aria-controls="features" role="tab" data-toggle="tab">Features</a></li>
					  <li role="presentation" class="active"><a href="#tech" aria-controls="tech" role="tab" data-toggle="tab">Tech Spech</a></li>
					  <li role="presentation"><a href="#guarantee" id="com_3" aria-controls="guarantee" role="tab" data-toggle="tab">guarantee</a></li>
					</ul>
				</div>
				<div class="tab-content items_tab">
					<div role="tabpanel" class="tab-pane fade in items_pane" id="features">
						<div class="features_box">
							<div class="single_features border_bot">
								<i class="flaticon-lightbulbs"></i>
								<div class="features_text">
									<h5><a href="#">Features 1</a></h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
								</div>
							</div>
							<div class="single_features border_bot border_left">
								<i class="fa fa-diamond"></i>
								<div class="features_text">
									<h5><a href="#">Features 2</a></h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
								</div>
							</div>
							<div class="single_features">
								<i class="fa fa-cogs"></i>
								<div class="features_text">
									<h5><a href="#">Features 3</a></h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
								</div>
							</div>
							<div class="single_features border_left">
								<i class="flaticon-tshirt17"></i>
								<div class="features_text">
									<h5><a href="#">Features 4</a></h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ab odio quas ipsam sed quo minima</p>
								</div>
							</div>
						</div>
						<div class="disclaimer text-left section-padding-top">
							<h5>disclaimer</h5>
							<i class="fa fa-dot-circle-o"></i>
							<p>1.00 $ trial offer applies to the first month of service only.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>Standard 14-day refund policy does not apply to any configurable options provided with Reseller packages or to</p>
							<p class="promo_p">promotional purchases of Reseller packages. Sales of $1.00 trial offer and add-ons are final and non-refundable.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>$1.00 trial offer is limited to one per household, business or client.</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade in active items_pane" id="tech">
						<div class="table-responsive">
							<table id="home_table">
								<tr>
									<th>package features</th>
									<th>COMPARE 1</th>
									<th>COMPARE 2</th>
									<th>COMPARE 3</th>
								</tr>
								<tr>
									<td>material</td>
									<td>100% Combed Cotton</td>
									<td>86% Organic Cotton</td>
									<td>100% Polyster</td>
								</tr>
								<tr>
									<td>GSM</td>
									<td>GSM 180</td>
									<td>GSM 160</td>
									<td>GSM 180</td>
								</tr>
								<tr>
									<td>COLOR</td>
									<td>Any Color</td>
									<td>Any Color</td>
									<td>Any Color</td>
								</tr>
								<tr>
									<td>FABRIC</td>
									<td>1000 m. Per Color</td>
									<td>800 m. Per Color</td>
									<td>900 m. Per Color</td>
								</tr>
								<tr>
									<td>SIZE</td>
									<td>Small</td>
									<td>Medium</td>
									<td>Large</td>
								</tr>
								<tr>
									<td>NECK</td>
									<td>Round Neck</td>
									<td>Kuff Neck</td>
									<td>Round Fit</td>
								</tr>
								<tr>
									<td>SLEEves</td>
									<td>Long Sleeves</td>
									<td>Half Sleeves</td>
									<td>Semi Half Sleeves</td>
								</tr>
							</table>
						</div>
						<div class="disclaimer text-left section-padding-top">
							<h5>disclaimer</h5>
							<i class="fa fa-dot-circle-o"></i>
							<p>1.00 $ trial offer applies to the first month of service only.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>Standard 14-day refund policy does not apply to any configurable options provided with Reseller packages or to</p>
							<p class="promo_p">promotional purchases of Reseller packages. Sales of $1.00 trial offer and add-ons are final and non-refundable.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>$1.00 trial offer is limited to one per household, business or client.</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade in items_pane" id="guarantee">
						<div class="guarantee_box">
							<div class="guarantee_features">
								<img src="{{ URL::asset('frontend_images/guarantee-icon.png') }}" alt="" />
								<div class="features_text guarantee_text">
									<h5><a href="#">GUARANTEE OF QUALITY</a></h5>
									<p>All of our web hosting services are backed up by our pioneering Hosting Guarantee. This guarantee is a mark of the high quality that you expect of Namecheap and underlines our commitment to providing excellence in our hosting division. Our Hosting Guarantee also explains that we treat each individual service you have with Namecheap as an individual service. You can subscribe, modify and cancel each and any service that you have with us at any time and without penalty.</p>
								</div>
							</div>
						</div>
						<div class="disclaimer text-left section-padding-top">
							<h5>disclaimer</h5>
							<i class="fa fa-dot-circle-o"></i>
							<p>1.00 $ trial offer applies to the first month of service only.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>Standard 14-day refund policy does not apply to any configurable options provided with Reseller packages or to</p>
							<p class="promo_p">promotional purchases of Reseller packages. Sales of $1.00 trial offer and add-ons are final and non-refundable.</p>
							<i class="fa fa-dot-circle-o"></i>
							<p>$1.00 trial offer is limited to one per household, business or client.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Compare-Ection-End  -->
@endsection