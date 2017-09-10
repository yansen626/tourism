$('#example').DataTable();

function addToCart(productId){
    $.ajax({
        url     : urlLink,
        method  : 'POST',
        data    : {
            // _token: CSRF_TOKEN,
            product_id  : productId
        },
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response){
            $("#add-cart-modal").modal()
        },
        error:function(){

        }
    });
}

function deleteCart(cartId){
    $.ajax({
        url     : urlLinkDelete,
        method  : 'POST',
        data    : {
            cart_id  : cartId
        },
        headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success : function(response){
            $("#cart_item_" + cartId).fadeOut("normal", function() {
                $(this).remove();
            });

            $priceTemp = $("total-price-value").val();
            $newPrice = $priceTemp - response;
            $("total-price-value").val($newPrice);


        },
        error:function(){
            alert("error!!!!");
        }
    });
}

function editCartQuantity(cartId){
var quantity = $('#cart_quantity_'+cartId).val();
var productSubtotal = '#product-subtotal-' + cartId;
if(quantity){
    $.ajax({
        url     : urlLinkEdit,
        method  : 'POST',
        dataType: 'JSON',
        data    : {
            cart_id  : cartId,
            quantity: quantity
        },
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response){
            var newSinglePrice = "Rp. " + response.singlePrice;
            $(productSubtotal).html(newSinglePrice);

            var newtotalPrice = "Rp. " + response.totalPrice;
            $('#sub-total-price').html(newtotalPrice);
            $('#total-price').html(newtotalPrice);
        },
        error:function(){

        }
    });
}
}