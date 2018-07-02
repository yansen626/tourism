@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div class="container page">
            <div class="row">
                <!-- content-->
                <div class="col-lg-10 col-lg-offset-1 woocommerce">
                    <form action="#" method="post">
                        <table class="shop_table cart">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Product</th>
                                <th class="product-name"> </th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="cart_item">
                                <td class="product-thumbnail"><a href="shop-single.html"><img src="pic/shop/240x300/4.jpg" data-at2x="pic/shop/240x300/4@2x.jpg" alt="" class="attachment-shop_thumbnail wp-post-image"></a></td>
                                <td class="product-name"><a href="shop-single.html">Integer ante arcu</a></td>
                                <td class="product-price"><span class="amount">155.00<sup>$</sup></span></td>
                                <td class="product-quantity">
                                    <div class="quantity buttons_added">
                                        <input type="number" step="1" min="0" name="cart" value="2" title="Qty" class="input-text qty text">
                                    </div>
                                </td>
                                <td class="product-subtotal"><span class="amount">310.00<sup>$</sup></span></td>
                                <td class="product-remove"><a href="#" title="Remove this item" class="remove"></a></td>
                            </tr>
                            <tr class="cart_item">
                                <td class="product-thumbnail"><a href="shop-single.html"><img src="pic/shop/240x300/3.jpg" data-at2x="pic/shop/240x300/3@2x.jpg" alt="" class="attachment-shop_thumbnail wp-post-image"></a></td>
                                <td class="product-name"><a href="shop-single.html">Maecenas tempus</a></td>
                                <td class="product-price"><span class="amount">220.00<sup>$</sup></span></td>
                                <td class="product-quantity">
                                    <div class="quantity buttons_added">
                                        <input type="number" step="1" min="0" name="cart" value="1" title="Qty" class="input-text qty text">
                                    </div>
                                </td>
                                <td class="product-subtotal"><span class="amount">220.00<sup>$</sup></span></td>
                                <td class="product-remove"><a href="#" title="Remove this item" class="remove"></a></td>
                            </tr>
                            <tr class="cart_item last">
                                <td class="product-thumbnail"><a href="shop-single.html"><img src="pic/shop/240x300/5.jpg" data-at2x="pic/shop/240x300/5@2x.jpg" alt="" class="attachment-shop_thumbnail wp-post-image"></a></td>
                                <td class="product-name"><a href="shop-single.html">Curabitur ullam corper ultrici</a></td>
                                <td class="product-price"><span class="amount">170.00<sup>$</sup></span></td>
                                <td class="product-quantity">
                                    <div class="quantity buttons_added">
                                        <input type="number" step="1" min="0" name="cart" value="2" title="Qty" class="input-text qty text">
                                    </div>
                                </td>
                                <td class="product-subtotal"><span class="amount">340.00<sup>$</sup></span></td>
                                <td class="product-remove"><a href="#" title="Remove this item" class="remove"></a></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="actions">
                                    <div class="coupon">
                                        <label for="coupon_code">Coupon:</label>
                                        <input id="coupon_code" type="text" name="coupon_code" value="" placeholder="Coupon code" class="input-text corner-radius-top">
                                        <input type="submit" name="apply_coupon" value="Apply" class="cws-button alt">
                                    </div>
                                    <input type="submit" name="update_cart" value="Update Cart" class="cws-button">
                                    <input type="submit" name="proceed" value="Proceed to Checkout" class="cws-button">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row mt-60">
                        <div class="col-md-12 mb-md-60">
                            <h2 class="mb-30 mt-0">Cart Totals</h2>
                            <table class="total-table">
                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">$870.00</span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td>Free Shipping</td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><span class="amount">$870.00</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ! content-->
            </div>
        </div>
    </div>


	@include('frontend.partials._modal-login')
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection