//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
    $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$('#example').DataTable();

function addToCart(productId){
    var color = '';
    if($('#select-color').length > 0){
        color = $('#select-color').val();
    }
    var size = '';
    if($('#select-size').length > 0){
        size = $('#select-size').val();
    }

    var weight = '';
    if($('#select-weight').length > 0){
        weight = $('#select-weight').val();
    }

    var qty = '';
    if($('#select-qty').length > 0){
        qty = $('#select-qty').val();
    }

    var buyerNote = $('#buyer_note').val();
    var cartQty = $('#cart_qty').val();

    $.ajax({
        url     : urlLink,
        method  : 'POST',
        data    : {
            // _token: CSRF_TOKEN,
            product_id  : productId,
            color : color,
            size:  size,
            weight: weight,
            qty: qty,
            buyerNote: buyerNote,
            cartQty: cartQty
        },
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response){
            $('#modal-cart-add').modal('toggle');
            if(response.success === true){
                $("#modal-add-cart-success").modal()
            }
            else{
                if(response.error === "login"){
                    var redirect = window.location.href;
                    window.location = "/login?redirect=" + redirect;
                }
                else{
                    alert("Out of Stock");
                }
            }
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

function getNotes(id){
    $.get('/cart/check/' + id, function (data) {
        if(data.success === true) {
            $('#modal-cart-note').modal();

            if(data.notes !== 'default'){
                $('#buyer_note').val(data.notes);
            }

            $('#cart_id').val(id);
        }
    });
}

function addToCartNotes(productId){

    var color = '';
    if($('#select-color').length > 0){
        color = $('#select-color').val();
    }
    var size = '';
    if($('#select-size').length > 0){
        size = $('#select-size').val();
    }

    var weight = '';
    if($('#select-weight').length > 0){
        weight = $('#select-weight').val();
    }

    var qty = '';
    if($('#select-qty').length > 0){
        qty = $('#select-qty').val();
    }

    $.ajax({
        url     : urlCheckNoteLink,
        method  : 'POST',
        data    : {
            // _token: CSRF_TOKEN,
            product_id  : productId,
            color : color,
            size:  size,
            weight: weight,
            qty: qty
        },
        headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success : function(response){
            $('#modal-cart-add').modal();

            if(response.notes !== 'default'){
                $('#buyer_note').val(response.notes);
            }
        },
        error:function(){

        }
    });

}

// autoNumeric
numberFormat = AutoNumeric.multiple('.price-format > input', {
    decimalCharacter: ',',
    digitGroupSeparator: '.',
    decimalPlaces: 0
});

//SELECT PAYMENT
function handleChangePayment(myRadio){
    var selectedValue = myRadio.value;
    var grandTotalValue = $("#grand-total-value").val();
    grandTotalValue = grandTotalValue.replace(/[.]/g, "");
    var newGrandTotalValue = 0;
    var newGrandTotal = "";
    var selectedFeeValue = $("#selected-fee").val();
    selectedFeeValue = selectedFeeValue.replace(/[.]/g, "");
    var selectedFee = "";

    if(selectedValue == "bank_transfer"){
        newGrandTotalValue = parseInt(grandTotalValue) - parseInt(selectedFeeValue) + 4000;
        newGrandTotal = addCommas(newGrandTotalValue);

        $("#selected-fee").val(4000);
        $('#admin-fee').html(addCommas(4000));
        $("#grand-total-value").val(newGrandTotalValue);
        $("#grand-total-price").html(newGrandTotal);
    }
    else{
        var fee = ((parseInt(grandTotalValue) - parseInt(selectedFeeValue)) * 0.03) + 2000;
        selectedFee = addCommas(fee);
        newGrandTotalValue = parseInt(grandTotalValue) - parseInt(selectedFeeValue) + fee;
        newGrandTotal = addCommas(newGrandTotalValue);

        $("#selected-fee").val(fee);
        $('#admin-fee').html(selectedFee);
        $("#grand-total-value").val(newGrandTotalValue);
        $("#grand-total-price").html(newGrandTotal);
    }
}


function addCommas(nStr) {
    nStr += '';
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return "Rp " + x1 + x2;
}

// SELECTIONS IN PRODUCT DETAIL
function onchangeSize(e){
    var obj = e.options[e.selectedIndex];

    var price = obj.getAttribute('data-price');
    if(price !== '0'){
        $('#price-label').html("Rp " + price);
    }
    var weight = obj.getAttribute('data-weight');
    if(weight !== '0' || weight !== ''){
        $('#weight-label').html("Weight: " + weight + " Kg");
    }
}

function onchangeWeight(e){
    var price = e.options[e.selectedIndex].getAttribute('data-price');
    $('#price-label').html("Rp " + price);

    var weight = e.options[e.selectedIndex].getAttribute('data-weight');
    if(weight !== '0'){
        $('#weight-label').html("Weight: " + weight + " Kg");
    }
}

function onchangeQty(e){
    var price = e.options[e.selectedIndex].getAttribute('data-price');
    $('#price-label').html("Rp " + price);

    var weight = e.options[e.selectedIndex].getAttribute('data-weight');
    if(weight !== 0){
        $('#weight-label').html("Weight: " + weight + " Kg");
    }
}
// END SELECTIOn

function loginRedirect(){
    var redirect = window.location.href;
    window.location = "/login?redirect=" + redirect;
}