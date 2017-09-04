// Bootstrap File Input
$("#product-photos").fileinput({
    maxFilePreviewSize: 10240,
    showUpload: false,
    allowedFileExtensions: ["jpg", "jpeg", "png"]
});

$("#product-featured").fileinput({
    maxFilePreviewSize: 10240,
    showUpload: false,
    allowedFileExtensions: ["jpg", "jpeg", "png"]
});

// autoNumeric
numberFormat = AutoNumeric.multiple('.price-format > input', {
    decimalCharacter: ',',
    digitGroupSeparator: '.',
    decimalPlaces: 0
});

numberFormat2 = new AutoNumeric('#discount-percent', {
    maximumValue: 100,
    minimumValue: 0,
    decimalPlaces: 0
});

// Others
$("#disc-none-opt").change(function(){
    $("#disc-percent").hide(300);
    $("#disc-flat").hide(300);

    $("#discount-percent").removeAttr('required');
    $("#discount-flat").removeAttr('required');
});

$("#disc-percent-opt").change(function(){
    $("#disc-percent").show(300);
    $("#disc-flat").hide(300);

    $("#discount-percent").attr('required', true);
    $("#discount-flat").removeAttr('required');
});

$("#disc-flat-opt").change(function(){
    $("#disc-flat").show(300);
    $("#disc-percent").hide(300);

    $("#discount-flat").attr('required',true);
    $("#discount-percent").removeAttr('required');
});
