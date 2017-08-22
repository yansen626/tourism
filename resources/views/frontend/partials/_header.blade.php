<!-- Header-Section-Strat  -->
<header>
    <div class="container">
        <div class="header_top">
            <div class="row">
                <div class="col-md-6">
                    <div class="header_top_left float-left">
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                        <ul class="social_others">
                            <li><a><i class="fa fa-phone"></i>+8801711223344</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>support@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="header_top_right text-right">
                        <ul>
                            <li><a href="#">Account</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Register / Login</a></li>
                            <li class="searchbox">
                                <input type="search" placeholder="Search......" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
                                <input type="submit" class="searchbox-submit" value="">
                                <span class="searchbox-icon"><i class="fa fa-search"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mega_relative">
            <div class="col-xs-12 col-sm-2">
                <div class="logo head_lo">
                    <a href="index.html"><img src="{{ URL::asset('frontend_images/logo.png') }}" alt="Logo" /></a>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="mainmenu float-right">
                    <nav>
                        <ul>
                            <li><a href="index.html">HOME</a></li>
                            <li><a href="#"><i>NEW</i></a></li>
                            <li><a href="#">FEATURED</a></li>
                            <li><a href="#">BLOG</a></li>
                            <li><a href="#">BRAND</a></li>
                            <li><a href="#">OFFERS</a></li>
                            <li><a href="contact.html">CONTACT</a></li>
                            <li class="shop_icon">
                                <a href="checkout.html"><img src="{{ URL::asset('frontend_images/menu_icon_img.png') }}" alt="" /></a>
                                <span>10</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- mobile-menu-area start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="mobile-menu">
            <nav id="dropdown">
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="#">NEW</a></li>
                    <li><a href="#">FEATURED</a></li>
                    <li><a href="#">BLOG</a></li>
                    <li><a href="#">BRAND</a></li>
                    <li><a href="#">OFFERS</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- mobile-menu-area end -->
<!-- Header-Section-End  -->