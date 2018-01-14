<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('landing') }}" class="site_title"><i class="fa fa-paw"></i> <span>Lowids</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ URL::asset('admin_images/user.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>{{ \Illuminate\Support\Facades\Auth::guard('user_admins')->user()->first_name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin-dashboard') }}"><i class="fa fa-home"></i> Dashboard </a>
                    </li>
                    <li>
                        <a href="{{ route('new-order-list') }}">
                            <i class="fa fa-exclamation-triangle"></i> Pemesanan Baru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment-list') }}">
                            <i class="fa fa-money"></i> Status Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manual-transfer-payment-list') }}">
                            <i class="fa fa-money"></i> Status Transfer Bank Customer
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer-list') }}">
                            <i class="fa fa-users"></i> Customer
                        </a>
                    </li>
                    <li><a><i class="fa fa-tags"></i> Produk <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('product-list') }}">Daftar Produk</a></li>
                            <li><a href="{{ route('product-create') }}">Tambah Produk</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Banner <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a>Banner Slider <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub-menu"><a href="{{ route('slider-banner-list', ['type'  => 'top_first_banner']) }}">Daftar Banner</a></li>
                                    <li><a href="{{ route('slider-banner-create', ['type'  => 'top_first_banner']) }}">Tambah Banner</a></li>
                                </ul>
                            </li>
                            {{--<li><a href="{{ route('slider-banner-list', ['type'  => 'top_first_banner']) }}">Slider Banner</a></li>--}}
                            <li><a href="{{ route('top-banner-list') }}">Banner Atas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('report-form') }}">
                            <i class="fa fa-bar-chart"></i> Laporan</span>
                        </a>
                    </li>
                    <li><a><i class="fa fa-picture-o"></i> Galeri <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            {{--<li><a href="{{ route('slider-banner-list', ['type'  => 'top_first_banner']) }}">Slider Banner</a></li>--}}
                            <li><a href="{{ route('gallery-list') }}">Daftar Galeri</a></li>
                            <li><a href="{{ route('gallery-create') }}">Tambah Galeri</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('delivery-list') }}">Konfirmasi Pengiriman</a></li>
                            <li><a href="{{ route('transaction-list') }}">Daftar Transaksi</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i> Kategori <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('category-list') }}">Daftar Kategori</a></li>
                            <li><a href="{{ route('category-create') }}">Tambah Kategori</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bank"></i> Metode Pembayaran<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('payment-method-show') }}">Daftar Metode</a></li>
                            <li><a href="{{ route('payment-method-create') }}">Tambah Metode</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-truck"></i> Kurir <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('courier-list') }}">Daftar Kurir</a></li>
                            <li><a href="{{ route('courier-create') }}">Tambah Kurir</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-truck"></i> Jenis Pengiriman <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('delivery-type-list') }}">Daftar Jenis</a></li>
                            <li><a href="{{ route('delivery-type-create') }}">Tambah Jenis</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Jenis Status <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('status-list') }}">Daftar Status</a></li>
                            <li><a href="{{ route('status-create') }}">Tambah Status</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin-list') }}">
                            <i class="fa fa-user-secret"></i> Daftar Admin</span>
                        </a>
                    </li>
                    <li><a><i class="fa fa-gear"></i> Pengaturan Toko <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('store-address') }}">Alamat Toko</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin-logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>