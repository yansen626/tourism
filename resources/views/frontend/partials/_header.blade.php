@inject('categories', 'App\Service\CategoryHeader')

<!-- HEADER -->
<header>

    <!-- TOP INFO -->
    {{--<div class="top_info">--}}

        {{--<!-- CONTAINER -->--}}
        {{--<div class="container clearfix">--}}
            {{--<ul class="secondary_menu">--}}
                {{--<li><a href="my-account.html" >my account</a></li>--}}
                {{--<li><a href="my-account.html" >Register</a></li>--}}
            {{--</ul>--}}
            {{--<div class="live_chat"><a href="javascript:void(0);" ><i class="fa fa-comment-o"></i> Live chat</a></div>--}}
            {{--<div class="phone_top">have a question? <a href="tel:1 800 888 2828" >1 800 888 2828</a></div>--}}
        {{--</div><!-- //CONTAINER -->--}}
    {{--</div><!-- TOP INFO -->--}}

    <!-- MENU BLOCK -->

    <div class="menu_block">

        <!-- CONTAINER -->
        <div class="container clearfix">

            <!-- LOGO -->
            <div class="logo text-center">
                <a href="{{ route('landing') }}" ><img src="{{ URL::asset('frontend_images/lowids_text_logo.png') }}" alt=""/></a>
            </div><!-- //LOGO -->

            <div class="logo-caption text-center">
                &nbsp;<h3 style="text-transform: capitalize;">Bahan Kue</h3>
            </div>

            <!-- USER MENU -->
            <div class="shopping_bag">
                <a class="shopping_bag_btn" id="menu-profile" href="javascript:void(0);"><i class="fa fa-user"></i><p></p></a>
                <div class="cart" id="submenu-profile" >
                    <ul class="cart-items">
                        @if(auth()->check())
                            <li class="clearfix">
                                Selamat Datang,<br/>
                                {{ \Illuminate\Support\Facades\Auth::user()->first_name }} {{ \Illuminate\Support\Facades\Auth::user()->last_name }}
                            </li>
                            <li class="clearfix"><a href="{{ route('user-profile') }}" >Profil</a></li>
                            <li class="clearfix"><a href="{{ route('user-payment-list') }}" >Transaksi</a></li>
                            <li class="clearfix">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li class="clearfix"><a href="{{ route('login') }}" >Masuk</a></li>
                            <li class="clearfix"><a href="{{ route('register') }}" >Daftar</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- USER MENU -->

            <!-- SEARCH FORM -->
            <div class="top_search_form">
                <a class="top_search_btn" href="javascript:void(0);" ><i class="fa fa-search"></i></a>
                <form method="get" onsubmit="return false;">
                    @if(!empty($searchKey))
                        <input type="text" id="search" name="search" style="padding: 10px;" onkeypress="searchKey(event)" placeholder="Search" value="{{ $searchKey }}"/>
                    @else
                        <input type="text" id="search" name="search" style="padding: 10px;" onkeypress="searchKey(event)" placeholder="Search"/>
                    @endif
                </form>
            </div>
            <!-- SEARCH FORM -->

            <!-- SHOPPING BAG -->
            <div class="shopping_bag">
                @if(Session::has('cartList') && Session::has('cartTotal'))
                    @php ( $cartTotal = Session::get('cartTotal')  )
                    @php ( $cartList = Session::get('cartList')  )

                    @if($cartTotal != '0')
                    <a class="shopping_bag_btn" id="menu-cart" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>KERANJANG BELANJA</p><span>{{$cartTotal}}</span></a>
                    <div class="cart" id="submenu-cart">
                        <ul class="cart-items">
                            @php( $idx = 1 )
                            @foreach($cartList as $cart)
                                @if($idx == 3)
                                    @break
                                @endif
                                <li class="clearfix">
                                    <div class="cart-image-header" style="background-image: url('{{ asset('storage/product/'. $cart->product->product_image()->where('featured', 1)->first()->path) }}')"></div>
                                    <a class="cart_item_title">{{$cart->product->name}}</a>
                                    <span class="cart_item_price">{{$cart->quantity}} x Rp {{$cart->product->price_discounted}}</span>
                                </li>
                                @php( $idx++ )
                            @endforeach
                        </ul>
                        <div class="cart_total">
                            <a class="btn btn-primary" href="{{ route('cart-list') }}">Lihat Semua</a>
                        </div>
                    </div>
                    @else
                        <a class="shopping_bag_btn" href="{{ route('cart-list') }}" ><i class="fa fa-shopping-cart"></i><p>KERANJANG BELANJA</p></a>
                    @endif
                @else
                    <a class="shopping_bag_btn" href="{{ route('cart-list') }}" ><i class="fa fa-shopping-cart"></i><p>KERANJANG BELANJA</p></a>
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
                {{--<li class="sub-menu"><a href="{{ route('products', ['categoryId' => 0, 'categoryName' => 'all']) }}" >Products</a>--}}
                    {{--<!-- MEGA MENU -->--}}
                    {{--<ul class="mega_menu megamenu_col1 clearfix">--}}
                        {{--<li class="col">--}}
                            {{--<ol>--}}
                                {{--@foreach($categories::allCategory() as $category)--}}
                                    {{--<li><a href="{{ route('products', ['categoryId' => $category->id, 'categoryName' => $category->name]) }}" >{{ $category->name }}</a></li>--}}
                                {{--@endforeach--}}
                            {{--</ol>--}}
                        {{--</li>--}}
                    {{--</ul><!-- //MEGA MENU -->--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{{ route('landing') }}" >Home</a>--}}
                {{--</li>--}}
                {{--@foreach($categories::allCategory() as $category)--}}
                    {{--<li><a href="{{ route('products', ['categoryId' => $category->id, 'categoryName' => $category->name]) }}" >{{ $category->name }}</a></li>--}}
                {{--@endforeach--}}
                <li class="sub-menu"><a href="javascript:void(0);" >Kategori</a>
                    <!-- MEGA MENU -->
                    <ul class="mega_menu megamenu_col3 clearfix">
                        <?php
                            $categoryAll = $categories::allCategory();
                            $categoryTotal = $categoryAll->count();
                            if($categoryTotal % 3 == 1){
                                $first = ($categoryTotal + 2) / 3;
                            }
                            elseif($categoryTotal % 3 == 2){
                                $first = ($categoryTotal + 1) / 3;
                            }
                            else{
                                $first = $categoryTotal / 3;
                            }

                            $second = $first + $first;
                        ?>
                        <li class="col">
                            <ol>
                                {{--@foreach($categories::allCategory() as $category)--}}
                                    {{--<li><a href="{{ route('products', ['categoryId' => $category->id, 'categoryName' => $category->name]) }}" >{{ $category->name }}</a></li>--}}
                                {{--@endforeach--}}
                                @for($i = 0; $i < $first; $i++)
                                        <li><a href="{{ route('products', ['categoryId' => $categoryAll[$i]->id, 'categoryName' => $categoryAll[$i]->name]) }}" >{{ $categoryAll[$i]->name }}</a></li>
                                @endfor
                            </ol>
                        </li>
                        <li class="col">
                            <ol>
                                @for($i = ($categoryTotal - $second) + 1; $i < $second; $i++)
                                    <li><a href="{{ route('products', ['categoryId' => $categoryAll[$i]->id, 'categoryName' => $categoryAll[$i]->name]) }}" >{{ $categoryAll[$i]->name }}</a></li>
                                @endfor
                            </ol>
                        </li>
                        <li class="col">
                            <ol>
                                @for($i = $second; $i < $categoryTotal; $i++)
                                    <li><a href="{{ route('products', ['categoryId' => $categoryAll[$i]->id, 'categoryName' => $categoryAll[$i]->name]) }}" >{{ $categoryAll[$i]->name }}</a></li>
                                @endfor
                            </ol>
                        </li>
                    </ul>
                    <!-- //MEGA MENU -->
                </li>
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