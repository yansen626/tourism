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
                {{--<a href="{{ route('product-list', ['categoryId' => 0]) }}" >Back to shop<i class="fa fa-angle-right"></i></a>--}}
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
                            @php ( $productTotalId = "product-subtotal-".$cart->id )
                            <tr class="cart_item" id="{{ $trId }}">
                                <td class="product-thumbnail">
                                        {{--<img src="{{ asset('storage\product\\'. $cart->product->product_image()->where('featured', 1)->first()->path) }}" width="100px" alt="" /></a>--}}
                                    <div class="cart-image" style="background-image: url('{{ asset('storage/product/'. $cart->product->product_image()->where('featured', 1)->first()->path) }}')"></div>
                                </td>
                                <td class="product-name">
                                    <a href="{{ route('product-detail', ['id' => $cart->product->id]) }}">
                                        @if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->size_option))
                                            {{ $cart->product->name }} - {{ $cart->size_option }}
                                        @elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->size_option))
                                            @php( $weightVal = floatval(floatval($cart->weight_option) / 1000)  )
                                            {{ $cart->product->name }} - {{ $weightVal }} Kg
                                        @elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option))
                                            {{ $cart->product->name }} - {{ $cart->qty_option }}
                                        @else
                                            {{ $cart->product->name }}
                                        @endif
                                    </a>
                                    <ul class="variation">
                                        <li class="variation-Color">Category: <span>{{$cart->Product->Category->name}}</span></li>
                                        @if(!empty($cart->note))
                                            @php( $notes = explode(';', $cart->note, 2) )
                                            @foreach($notes as $note)
                                                @if(!empty($note))
                                                    @php( $property = explode('=', $note, 2) )
                                                    <li class="variation-Color"><span>{{ $property[0] }}: {{ $property[1] }}</span></li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </td>
                                <td class="product-price">Rp. {{ $cart->price }}</td>
                                <td class="product-quantity">
                                    <input type="text" id="{{ $qtyId }}" value="{{ $cart->quantity }}" style="width:50%" onkeyup="editCartQuantity('{{ $cart->id }}')"/>
                                </td>
                                <td class="product-subtotal" id="{{ $productTotalId }}">Rp. {{ $cart->total_price }}</td>
                                <td class="product-remove"><a href="{{ route('delete-cart', ['cartId' => $cart->id]) }}"><i>X</i></a></td>
                            </tr>
                            <tr class="cart_item">
                                <td colspan="5" class="border_bottom">
                                    @if(!empty($cart->buyer_note))
                                        Note: {{ $cart->buyer_note }}
                                    @endif
                                </td>
                                <td class="border_bottom" style="padding-right: 0">
                                    @if(!empty($cart->buyer_note))
                                        <button class="btn btn-sm btn-dark">Edit Note</button>
                                    @else
                                        <button class="btn btn-sm btn-dark">Add Note</button>
                                    @endif
                                </td>
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
                                <td id="sub-total-price">Rp. {{ $totalPrice }}</td>
                            </tr>
                            <tr class="shipping clearfix">
                                <th>SHIPPING</th>
                                <td>-</td>
                            </tr>
                            <tr class="total clearfix">
                                <th>Total</th>
                                <td id="total-price">Rp. {{ $totalPrice }}</td>
                            </tr>
                        </table>

                        @if($carts->count() > 0)
                            <a class="btn btn-primary" href="{{ route('checkout') }}" >Check out</a>
                        @else
                            <button class="btn btn-primary" disabled>Check out</button>
                        @endif
                        {{--<a class="btn inactive" href="{{ route('product-list', ['categoryId' => 0]) }}" >Continue shopping</a>--}}
                    </div><!-- //REGISTRATION FORM -->
                </div><!-- //SIDEBAR -->
            </div><!-- //ROW -->
        </div><!-- //CONTAINER -->
    </section><!-- //SHOPPING BAG BLOCK -->

    <script>
        {{--var urlLinkDelete = '{{route('deleteCart')}}';--}}
        var urlLinkEdit = '{{route('editCart')}}';
    </script>
@endsection

@include('frontend.partials._modal')