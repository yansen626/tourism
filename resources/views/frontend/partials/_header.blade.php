
<!-- HEADER -->
<header>

    <!-- TOP INFO -->
    {{--<div class="top_info">--}}

        {{--<!-- CONTAINER -->--}}
        {{--<div class="container clearfix">--}}

            {{--<div class="phone_top">have a question? <a href="tel:1 800 888 2828" >1 800 888 2828</a></div>--}}
        {{--</div><!-- //CONTAINER -->--}}
    {{--</div><!-- TOP INFO -->--}}

    <!-- MENU BLOCK -->
    <div class="menu_block">

        <!-- CONTAINER -->
        <div class="container clearfix">

            <!-- LOGO -->
            <div class="logo">
                <a href="{{ route('landing') }}" ><img src="{{ URL::asset('frontend_images/logo.png') }}" alt="" /></a>
            </div><!-- //LOGO -->

            <!-- USER MENU -->
            <div class="shopping_bag">
                <a class="shopping_bag_btn" id="menu-profile" href="javascript:void(0);" style="padding:15px"><i class="fa fa-user fa-2x"></i><p></p></a>
                <div class="cart" id="submenu-profile" >
                    <ul class="cart-items">
                        @if(auth()->check())
                            <li class="clearfix">
                                Welcome,<br/>
                                {{ \Illuminate\Support\Facades\Auth::user()->first_name }} {{ \Illuminate\Support\Facades\Auth::user()->last_name }}
                            </li>
                            <li class="clearfix"><a href="{{ route('user-profile') }}" >Profile</a></li>
                            <li class="clearfix"><a href="{{ route('user-payment-list') }}" >Transaction</a></li>
                            <li class="clearfix">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li class="clearfix"><a href="{{ route('login') }}" >Login</a></li>
                            <li class="clearfix"><a href="{{ route('register') }}" >Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- USER MENU -->

            <!-- SEARCH FORM -->
            <div class="top_search_form">
                <a class="top_search_btn" href="javascript:void(0);" ><i class="fa fa-search"></i></a>
                <form method="get" action="#">
                    <input type="text" name="search" value="Search" onFocus="if (this.value == 'Search') this.value = '';" onBlur="if (this.value == '') this.value = 'Search';" />
                </form>
            </div>
            <!-- SEARCH FORM -->

            <!-- SHOPPING BAG -->
            <div class="shopping_bag">
                @if(Session::has('cartList') && Session::has('cartTotal'))
                    @php ( $cartTotal = Session::get('cartTotal')  )
                    @php ( $cartList = Session::get('cartList')  )

                    <a class="shopping_bag_btn" id="menu-cart" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>shopping cart</p><span>{{$cartTotal}}</span></a>
                    <div class="cart" id="submenu-cart">
                        <ul class="cart-items">
                            @if($cartTotal > 1)
                                @for($i=0; $i < 2; $i++)
                                    <li class="clearfix">
                                        <img class="cart_item_product" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                        <a href="product-page.html" class="cart_item_title">{{$cartList[$i]->Product->name}}</a>
                                        <span class="cart_item_price">{{$cartList[$i]->quantity}} x Rp {{$cartList[$i]->Product->price}}</span>
                                    </li>
                                @endfor
                            @else
                                @foreach($cartList as $cart)
                                    <li class="clearfix">
                                        <img class="cart_item_product" src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" alt="" />
                                        <a href="product-page.html" class="cart_item_title">{{$cart->Product->name}}</a>
                                        <span class="cart_item_price">{{$cart->quantity}} x Rp {{$cart->Product->price}}</span>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                        <div class="cart_total">
                            <a class="btn active" href="{{ route('cart-list') }}">View Cart</a>
                        </div>
                    </div>
                @else
                    <a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>shopping bag</p></a>
                @endif


            </div><!-- //SHOPPING BAG -->


            {{--<!-- LOVE LIST -->--}}
            {{--<div class="love_list">--}}
                {{--<a class="love_list_btn" href="javascript:void(0);" ><i class="fa fa-heart-o"></i><p>Love list</p><span>0</span></a>--}}
                {{--<div class="cart">--}}
                    {{--<ul class="cart-items">--}}
                        {{--<li>Cart is empty</li>--}}
                    {{--</ul>--}}
                    {{--<div class="cart_total">--}}
                        {{--<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>$0</b></span></div>--}}
                        {{--<a class="btn active" href="checkout.html">Checkout</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div><!-- //LOVE LIST -->--}}


            <!-- MENU -->
            <ul class="navmenu center">
                <li class="sub-menu"><a href="{{ route('products', ['categoryId' => 0]) }}" >Products</a>
                    <!-- MEGA MENU -->
                    <ul class="mega_menu megamenu_col1 clearfix">
                        <li class="col">
                            <ol>
                                <li><a href="{{ route('products', ['categoryId' => 1]) }}" >Tofieco Essense & Pasta</a></li>
                                <li><a href="{{ route('products', ['categoryId' => 2]) }}" >Rum,Pasta,Essence</a></li>
                                <li><a href="{{ route('products', ['categoryId' => 3]) }}" >Pewarna</a></li>
                            </ol>
                        </li>
                    </ul><!-- //MEGA MENU -->
                </li>
                {{--<li class="sub-menu"><a href="javascript:void(0);" >Men</a>--}}
                    {{--<!-- MEGA MENU -->--}}
                    {{--<ul class="mega_menu megamenu_col2 clearfix">--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="men.html" >sweaters</a></li>--}}
                                {{--<li><a href="men.html" >shirts & tops</a></li>--}}
                                {{--<li><a href="men.html" >knits & tees</a></li>--}}
                                {{--<li><a href="men.html" >pants</a></li>--}}
                                {{--<li><a href="men.html" >denim</a></li>--}}
                                {{--<li><a href="men.html" >dresses</a></li>--}}
                                {{--<li><a href="men.html" >maternity</a></li>--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="men.html" >skirts</a></li>--}}
                                {{--<li><a href="men.html" >shorts</a></li>--}}
                                {{--<li><a href="men.html" >blazers</a></li>--}}
                                {{--<li><a href="men.html" >outerwear</a></li>--}}
                                {{--<li><a href="men.html" >suiting</a></li>--}}
                                {{--<li><a href="men.html" >swim</a></li>--}}
                                {{--<li><a href="men.html" >sleepwear</a></li>--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                    {{--</ul><!-- //MEGA MENU -->--}}
                {{--</li>--}}
                {{--<li><a href="shoes.html" >shoes</a></li>--}}
                {{--<li class="sub-menu"><a href="javascript:void(0);" >Pages</a>--}}
                    {{--<!-- MEGA MENU -->--}}
                    {{--<ul class="mega_menu megamenu_col3 clearfix">--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="about.html" >About Us</a></li>--}}
                                {{--<li><a href="gallery.html" >Gallery<span>new</span></a></li>--}}
                                {{--<li><a href="product-page.html" >Product Page</a></li>--}}
                                {{--<li><a href="love-list.html" >Love List</a></li>--}}
                                {{--<li><a href="shopping-bag.html" >Shopping Bag</a></li>--}}
                                {{--<li><a href="my-account.html" >My Account</a></li>--}}

                            {{--</ol>--}}
                        {{--</li>--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="product-catalog.html" >Product Catalog</a></li>--}}
                                {{--<li><a href="brands-list.html" >Brands List</a></li>--}}
                                {{--<li><a href="update.html" >Site Update</a></li>--}}
                                {{--<li><a href="contacts.html" >Contacts</a></li>--}}
                                {{--<li><a href="shortcodes.html" >Shortcodes</a></li>--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="404.html" >404 Page</a></li>--}}
                                {{--<li><a href="articles.html" >Articles</a></li>--}}
                                {{--<li><a href="article-single.html" >Article Single</a></li>--}}
                                {{--<li><a href="checkout.html" >Checkout</a></li>--}}
                                {{--<li><a href="faq.html" >FAQ</a></li>--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                    {{--</ul><!-- //MEGA MENU -->--}}
                {{--</li>--}}
                {{--<li class="sub-menu"><a href="javascript:void(0);" >Blog</a>--}}
                    {{--<!-- MEGA MENU -->--}}
                    {{--<ul class="mega_menu megamenu_col1 clearfix">--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--<li><a href="blog.html" >Blog</a></li>--}}
                                {{--<li><a href="blog-post.html" >Blog Post</a></li>--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                    {{--</ul><!-- //MEGA MENU -->--}}
                {{--</li>--}}
                {{--<li class="last sale_menu"><a href="sale.html" >Sale</a></li>--}}
            </ul><!-- //MENU -->

        </div><!-- //MENU BLOCK -->
    </div><!-- //CONTAINER -->
</header><!-- //HEADER -->