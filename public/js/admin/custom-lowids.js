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
numberFormat = new AutoNumeric('.price-format', {
    commaDecimalCharDotSeparator: true
});

numberFormat2 = new AutoNumeric('#form-discount-percent', {
    maximumValue: 100,
    minimumValue: 0
});

// Others
$("#form-discount-toggler").change(function(){
    if(this.checked){
        $("#form-discount-toggle").show(300);
    }else{
        $("#form-discount-toggle").hide(300);
    }
})
