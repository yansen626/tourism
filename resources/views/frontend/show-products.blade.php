@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb women parallax margbot30">

        <!-- CONTAINER -->
        <div class="container">
            <h2>Women</h2>
        </div><!-- //CONTAINER -->
    </section><!-- //BREADCRUMBS -->


    <!-- SHOP BLOCK -->
    <section class="shop">

        <!-- CONTAINER -->
        <div class="container">

            <!-- ROW -->
            <div class="row">

                <!-- SIDEBAR -->
                <div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">

                    <!-- CATEGORIES -->
                    <div class="sidepanel widget_categories">
                        <h3>Product Categories</h3>
                        <ul>
                            <li><a href="javascript:void(0);" >Sweaters</a></li>
                            <li><a href="javascript:void(0);" >SHIRTS &amp; TOPS</a></li>
                            <li><a href="javascript:void(0);" >KNITS &amp; TEES</a></li>
                            <li><a href="javascript:void(0);" >PANTS</a></li>
                            <li><a href="javascript:void(0);" >DENIM</a></li>
                            <li><a href="javascript:void(0);" >DRESSES</a></li>
                            <li><a href="javascript:void(0);" >Maternity</a></li>
                        </ul>
                    </div><!-- //CATEGORIES -->

                    <!-- PRICE RANGE -->
                    <div class="sidepanel widget_pricefilter">
                        <h3>Filter by price</h3>
                        <div id="price-range" class="clearfix">
                            <label for="amount">Range:</label>
                            <input type="text" id="amount"/>
                            <div class="padding-range"><div id="slider-range"></div></div>
                        </div>
                    </div><!-- //PRICE RANGE -->

                    <!-- SHOP BY SIZE -->
                    <div class="sidepanel widget_sized">
                        <h3>SHOP BY SIZE</h3>
                        <ul>
                            <li><a class="sizeXS" href="javascript:void(0);" >XS</a></li>
                            <li class="active"><a class="sizeS" href="javascript:void(0);" >S</a></li>
                            <li><a class="sizeM" href="javascript:void(0);" >M</a></li>
                            <li><a class="sizeL" href="javascript:void(0);" >L</a></li>
                            <li><a class="sizeXL" href="javascript:void(0);" >XL</a></li>
                        </ul>
                    </div><!-- //SHOP BY SIZE -->

                    <!-- SHOP BY COLOR -->
                    <div class="sidepanel widget_color">
                        <h3>SHOP BY COLOR</h3>
                        <ul>
                            <li><a class="color1" href="javascript:void(0);" ></a></li>
                            <li class="active"><a class="color2" href="javascript:void(0);" ></a></li>
                            <li><a class="color3" href="javascript:void(0);" ></a></li>
                            <li><a class="color4" href="javascript:void(0);" ></a></li>
                            <li><a class="color5" href="javascript:void(0);" ></a></li>
                            <li><a class="color6" href="javascript:void(0);" ></a></li>
                            <li><a class="color7" href="javascript:void(0);" ></a></li>
                            <li><a class="color8" href="javascript:void(0);" ></a></li>
                        </ul>
                    </div><!-- //SHOP BY COLOR -->

                    <!-- SHOP BY BRANDS -->
                    <div class="sidepanel widget_brands">
                        <h3>SHOP BY BRANDS</h3>
                        <input type="checkbox" id="categorymanufacturer1" /><label for="categorymanufacturer1">VERSACE <span>(24)</span></label>
                        <input type="checkbox" id="categorymanufacturer2" /><label for="categorymanufacturer2">J CREW <span>(35)</span></label>
                        <input type="checkbox" id="categorymanufacturer3" /><label for="categorymanufacturer3">Calvin KlEin <span>(48)</span></label>
                        <input type="checkbox" id="categorymanufacturer4" /><label for="categorymanufacturer4">Tommy hilfiger <span>(129)</span></label>
                        <input type="checkbox" id="categorymanufacturer5" /><label for="categorymanufacturer5">Ralph Lauren <span>(69)</span></label>
                    </div><!-- //SHOP BY BRANDS -->

                    <!-- BANNERS WIDGET -->
                    <div class="widget_banners">
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner10.jpg') }}" alt="" /></a>
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner9.jpg') }}" alt="" /></a>
                        <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner8.jpg') }}" alt="" /></a>
                    </div><!-- //BANNERS WIDGET -->

                    <!-- NEWSLETTER FORM WIDGET -->
                    <div class="sidepanel widget_newsletter">
                        <div class="newsletter_wrapper">
                            <h3>NEWSLETTER</h3>
                            <form class="newsletter_form clearfix" action="javascript:void(0);" method="get">
                                <input type="text" name="newsletter" value="Enter E-mail & Get 10% off" onFocus="if (this.value == 'Enter E-mail & Get 10% off') this.value = '';" onBlur="if (this.value == '') this.value = 'Enter E-mail & Get 10% off';" />
                                <input class="btn newsletter_btn" type="submit" value="Sign up & get 10% off">
                            </form>
                        </div>
                    </div><!-- //NEWSLETTER FORM WIDGET -->
                </div><!-- //SIDEBAR -->


                <!-- SHOP PRODUCTS -->
                <div class="col-lg-9 col-sm-9 col-sm-9 padbot20">

                    <!-- SHOP BANNER -->
                    <div class="banner_block margbot15">
                        <a class="banner nobord" href="javascript:void(0);" ><img src="{{ URL::asset('frontend_images/tovar/banner21.jpg') }}" alt="" /></a>
                    </div><!-- //SHOP BANNER -->

                    <!-- SORTING TOVAR PANEL -->
                    <div class="sorting_options clearfix">

                        <!-- COUNT TOVAR ITEMS -->
                        <div class="count_tovar_items">
                            <p>Sweaters</p>
                            <span>194 Items</span>
                        </div><!-- //COUNT TOVAR ITEMS -->

                        <!-- TOVAR FILTER -->
                        <div class="product_sort">
                            <p>SORT BY</p>
                            <select class="basic">
                                <option value="">Popularity</option>
                                <option>Reting</option>
                                <option>Date</option>
                            </select>
                        </div><!-- //TOVAR FILTER -->

                        <!-- PRODUC SIZE -->
                        <div id="toggle-sizes">
                            <a class="view_box active" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
                            <a class="view_full" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
                        </div><!-- //PRODUC SIZE -->
                    </div><!-- //SORTING TOVAR PANEL -->


                    <!-- ROW -->
                    <div class="row shop_block">

                        <!-- TOVAR1 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/1_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Popover Sweatshirt in Floral Jacquard</a>
                                    <span class="tovar_price">$98.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR1 -->

                        <!-- TOVAR2 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/2.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/2_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/2.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Popover Sweatshirt in Floral Jacquard</a>
                                    <span class="tovar_price">$98.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR2 -->

                        <!-- TOVAR3 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/3.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/3_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/3.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Japanese indigo denim jacket</a>
                                    <span class="tovar_price">$158.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR3 -->

                        <!-- TOVAR4 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/4.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/4_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/4.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Peacoat trench</a>
                                    <span class="tovar_price">$298.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR4 -->

                        <!-- TOVAR5 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item tovar_sale clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/5.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/5_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/5.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Schoolboy blazer in italian wool</a>
                                    <span class="tovar_price">$194.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR5 -->

                        <!-- TOVAR6 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/6.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/6_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/6.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Cashmere mockneck sweater</a>
                                    <span class="tovar_price">$257.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR6 -->

                        <!-- TOVAR7 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/7.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/7_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/7.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Waxed canvas utility jacket</a>
                                    <span class="tovar_price">$168.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR7 -->

                        <!-- TOVAR8 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/8.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/8_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/8.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Thompson blazer in stretch cotton</a>
                                    <span class="tovar_price">$173.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR8 -->

                        <!-- TOVAR9 -->
                        <div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
                            <div class="tovar_item clearfix">
                                <div class="tovar_img">
                                    <div class="tovar_img_wrapper">
                                        <img class="img" src="{{ URL::asset('frontend_images/tovar/women/9.jpg') }}" alt="" />
                                        <img class="img_h" src="{{ URL::asset('frontend_images/tovar/women/9_2.jpg') }}" alt="" />
                                    </div>
                                    <div class="tovar_item_btns">
                                        <div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/9.html" ><span>quick</span> view</a></div>
                                        <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="tovar_description clearfix">
                                    <a class="tovar_title" href="product-page.html" >Vintage denim jacket in patina wash</a>
                                    <span class="tovar_price">$99.00</span>
                                </div>
                                <div class="tovar_content">What makes our cashmere so special? We start with the finest yarns from an Italian mill known for producing some of the softest cashmere out there.</div>
                            </div>
                        </div><!-- //TOVAR9 -->
                    </div><!-- //ROW -->

                    <hr>

                    <div class="clearfix">
                        <!-- PAGINATION -->
                        <ul class="pagination">
                            <li><a href="javascript:void(0);" >1</a></li>
                            <li><a href="javascript:void(0);" >2</a></li>
                            <li class="active"><a href="javascript:void(0);" >3</a></li>
                            <li><a href="javascript:void(0);" >4</a></li>
                            <li><a href="javascript:void(0);" >5</a></li>
                            <li><a href="javascript:void(0);" >6</a></li>
                            <li><a href="javascript:void(0);" >...</a></li>
                        </ul><!-- //PAGINATION -->

                        <a class="show_all_tovar" href="javascript:void(0);" >show all</a>

                    </div>

                </div><!-- //SHOP PRODUCTS -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //SHOP -->
@endsection