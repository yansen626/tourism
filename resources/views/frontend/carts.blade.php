@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30"></section>
    <!-- //BREADCRUMBS -->


    <!-- PAGE HEADER -->
    <section class="page_header">

        <!-- CONTAINER -->
        <div class="container">
            <h3 class="pull-left"><b>Shopping bag</b></h3>

            <div class="pull-right">
                <a href="{{ route('product-list', ['categoryId' => 0]) }}" >Back to shop<i class="fa fa-angle-right"></i></a>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //PAGE HEADER -->


    <!-- SHOPPING BAG BLOCK -->
    <section class="shopping_bag_block">

        <!-- CONTAINER -->
        <div class="container">

            <!-- ROW -->
            <div class="row">

                <!-- CART TABLE -->
                <div class="col-lg-9 col-md-9 padbot40">

                    <table class="shop_table">
                        <thead>
                        <tr>
                            <th class="product-thumbnail"></th>
                            <th class="product-name">Item</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                            <th class="product-remove"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($carts as $cart)
                            @php ( $trId = "cart_item_".$cart->id )
                            @php ( $qtyId = "cart_quantity_".$cart->id )
                            <tr class="cart_item" id="{{ $trId }}">
                                <td class="product-thumbnail"><a href="product-page.html" ><img src="{{ URL::asset('frontend_images/tovar/women/1.jpg') }}" width="100px" alt="" /></a></td>
                                <td class="product-name">
                                    <a href="{{ route('product-detail', ['id' => $cart->Product->id]) }}"> {{ $cart->Product->name }}</a>
                                    <ul class="variation">
                                        <li class="variation-Color">Category: <span>{{$cart->Product->Category->name}}</span></li>
                                    </ul>
                                </td>

                                <td class="product-price">Rp. {{$cart->Product->price}}</td>

                                <td class="product-quantity">
                                    <input type="text" id="{{$qtyId}}" value="{{$cart->quantity}}" style="width:50%" onkeyup="editCartQuantity('{{ $cart->id }}')"/>
                                </td>

                                <td class="product-subtotal">Rp. {{$cart->total_price}}</td>

                                <td class="product-remove"><a href="javascript:void(0);" onclick="deleteCart('{{ $cart->id }}')"><i>X</i></a></td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div><!-- //CART TABLE -->


                <!-- SIDEBAR -->
                <div id="sidebar" class="col-lg-3 col-md-3 padbot50">

                    <!-- BAG TOTALS -->
                    <div class="sidepanel widget_bag_totals">
                        <h3>BAG TOTALS</h3>
                        <table class="bag_total">
                            <tr class="cart-subtotal clearfix">
                                <th>Sub total</th>
                                <td>Rp. {{$totalPrice}}</td>
                            </tr>
                            <tr class="shipping clearfix">
                                <th>SHIPPING</th>
                                <td>-</td>
                            </tr>
                            <tr class="total clearfix">
                                <th>Total</th>
                                <td>Rp. {{$totalPrice}}</td>
                            </tr>
                        </table>
                        <a class="btn active" href="{{ route('checkout') }}" >Check out</a>
                        <a class="btn inactive" href="{{ route('product-list', ['categoryId' => 0]) }}" >Continue shopping</a>
                    </div><!-- //REGISTRATION FORM -->
                </div><!-- //SIDEBAR -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //SHOPPING BAG BLOCK -->

    <script>
        var urlLinkDelete = '{{route('deleteCart')}}';
        var urlLinkEdit = '{{route('editCart')}}';
    </script>
@endsection

@include('frontend.partials._modal')