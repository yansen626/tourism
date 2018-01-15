$("#datatable-global").DataTable({
    "responsive": {
        details: {
            display: $.fn.dataTable.Responsive.display.childRowImmediate,
            type: ''
        }
    }
})

$("#datatable-payment").DataTable({
    "order": [[7, 'desc']],
    "responsive": {
        details: {
            display: $.fn.dataTable.Responsive.display.childRowImmediate,
            type: ''
        }
    }
})

// Bootstrap File Input
$("#product-photos").fileinput({
    maxFilePreviewSize: 10240,
    showUpload: false,
    allowedFileExtensions: ["jpg", "jpeg", "png"]
});

$("#image").fileinput({
    maxFilePreviewSize: 10240,
    showUpload: false,
    allowedFileExtensions: ["jpg", "jpeg", "png"]
});

var imgFeaturedPath = $("#product-featured").attr('data-image-featured-path');
if(imgFeaturedPath != ''){
    $("#product-featured").fileinput({
        initialPreview:[imgFeaturedPath],
        overwriteInitial: true,
        maxFilePreviewSize: 10240,
        showUpload: false,
        initialPreviewAsData: true,
        allowedFileExtensions: ["jpg", "jpeg", "png"]
    });
}
else{
    $("#product-featured").fileinput({
        maxFilePreviewSize: 10240,
        showUpload: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"]
    });
}

var sliderImgPath = $("#image-edit").attr('data-image');
if(sliderImgPath != ''){
    $("#image-edit").fileinput({
        initialPreview:[sliderImgPath],
        overwriteInitial: true,
        maxFilePreviewSize: 10240,
        showUpload: false,
        initialPreviewAsData: true,
        allowedFileExtensions: ["jpg", "jpeg", "png"]
    });
}
else{
    $("#image").fileinput({
        maxFilePreviewSize: 10240,
        showUpload: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"]
    });
}

$("#product-featured").on('fileloaded', function(event, file, previewId, index, reader){
    $("#img_featured_changed").val("new");
});

// autoNumeric
numberFormat = AutoNumeric.multiple('.price-format > input', {
    decimalCharacter: ',',
    digitGroupSeparator: '.',
    decimalPlaces: 0
});

if($('#discount-percent').length > 0){
    numberFormat2 = new AutoNumeric('#discount-percent', {
        maximumValue: 100,
        minimumValue: 0,
        decimalPlaces: 0
    });
}

if($('#qty').length > 0){
    numberFormat2 = new AutoNumeric('#qty', {
        maximumValue: 9999,
        minimumValue: 0,
        decimalPlaces: 0
    });
}

// Set Color & Size & Weight
$(".add-more-color").click(function(){
    var html = $(".copy-color").html();
    $(".after-add-more-color").after(html);
});

$("body").on("click",".remove-color",function(){
    $(this).parents(".control-group-color").remove();
});

$(".add-more-size").click(function(){
    var html = $(".copy-size").html();
    $(".after-add-more-size").after(html);
});

$("body").on("click",".remove-size",function(){
    $(this).parents(".control-group-size").remove();
});

$(".add-more-weight").click(function(){
    var html = $(".copy-weight").html();
    $(".after-add-more-weight").after(html);
});

$("body").on("click",".remove-weight",function(){
    $(this).parents(".control-group-weight").remove();
});

$(".add-more-qty").click(function(){
    var html = $(".copy-qty").html();
    $(".after-add-more-qty").after(html);
});

$("body").on("click",".remove-qty",function(){
    $(this).parents(".control-group-qty").remove();
});

$("#color-no-opt").change(function(){
    $("#input-group-color").hide(300);
});

$("#color-yes-opt").change(function(){
    $("#input-group-color").show(300);
});

$("#size-no-opt").change(function(){
    $("#input-group-size").hide(300);
    $("#price").attr('required', true);
    $("#weight").attr('required',true);
    $("#form-weight-section").show(300);
    $("#form-price-section").show(300);
    $("#form-discount-section").show(300);
    $("#form-weight-option").show(300);
    $("#form-qty-option").show(300);
    $("#form-stock-section").show(300);
});

$("#size-yes-opt").change(function(){
    $("#input-group-size").show(300);
    $("#price").removeAttr('required');
    $("#weight").removeAttr('required');
    $("#form-weight-section").hide(300);
    $("#form-price-section").hide(300);
    $("#form-discount-section").hide(300);
    $("#form-weight-option").hide(300);
    $("#form-qty-option").hide(300);
    $("#form-stock-section").hide(300);

    // Hide discount sections
    $("#form-discount-section").hide(300);
    $("#disc-percent").hide(300);
    $("#disc-flat").hide(300);
    $("#discount-percent").removeAttr('required');
    $("#discount-flat").removeAttr('required');

    // Reset discount buttons
    $("#disc-percent-opt").removeAttr('checked');
    $("#disc-percent-opt").parent('label').removeClass('active');
    $("#disc-flat-opt").removeAttr('checked');
    $("#disc-flat-opt").parent('label').removeClass('active');
    $("#disc-none-opt").attr('checked', true);
    $("#disc-none-opt").parent('label').addClass('active');
});

$("#weight-no-opt").change(function(){
    $("#input-group-weight").hide(300);
    $("#price").attr('required',true);
    $("#form-price-section").show(300);
    $("#weight").attr('required',true);
    $("#form-weight-section").show(300);
    $("#form-discount-section").show(300);
    $("#form-size-option").show(300);
    $("#form-qty-option").show(300);
    $("#form-stock-section").show(300);
});

$("#weight-yes-opt").change(function(){
    $("#input-group-weight").show(300);
    $("#price").removeAttr('required');
    $("#form-price-section").hide(300);
    $("#weight").removeAttr('required');
    $("#form-weight-section").hide(300);
    $("#form-size-option").hide(300);
    $("#form-qty-option").hide(300);
    $("#form-stock-section").hide(300);

    // Hide discount sections
    $("#form-discount-section").hide(300);
    $("#disc-percent").hide(300);
    $("#disc-flat").hide(300);
    $("#discount-percent").removeAttr('required');
    $("#discount-flat").removeAttr('required');

    // Reset discount buttons
    $("#disc-percent-opt").removeAttr('checked');
    $("#disc-percent-opt").parent('label').removeClass('active');
    $("#disc-flat-opt").removeAttr('checked');
    $("#disc-flat-opt").parent('label').removeClass('active');
    $("#disc-none-opt").attr('checked', true);
    $("#disc-none-opt").parent('label').addClass('active');
});

$("#qty-no-opt").change(function(){
    $("#input-group-qty").hide(300);
    $("#price").attr('required', true);
    $("#form-price-section").show(300);
    $("#weight").attr('required',true);
    $("#form-discount-section").show(300);
    $("#form-weight-option").show(300);
    $("#form-size-option").show(300);
    $("#form-stock-section").show(300);
});

$("#qty-yes-opt").change(function(){
    $("#input-group-qty").show(300);
    $("#price").removeAttr('required');
    $("#form-price-section").hide(300);
    $("#weight").removeAttr('required');
    $("#form-weight-section").hide(300);
    $("#form-weight-option").hide(300);
    $("#form-size-option").hide(300);
    $("#form-stock-section").hide(300);

    // Hide discount sections
    $("#form-discount-section").hide(300);
    $("#disc-percent").hide(300);
    $("#disc-flat").hide(300);
    $("#discount-percent").removeAttr('required');
    $("#discount-flat").removeAttr('required');

    // Reset discount buttons
    $("#disc-percent-opt").removeAttr('checked');
    $("#disc-percent-opt").parent('label').removeClass('active');
    $("#disc-flat-opt").removeAttr('checked');
    $("#disc-flat-opt").parent('label').removeClass('active');
    $("#disc-none-opt").attr('checked', true);
    $("#disc-none-opt").parent('label').addClass('active');
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

// Edit Product
function makeFeatured(id){
    var el = document.getElementsByClassName('cover-item');
    for(var i = 0; i < el.length; i++){
        var element = el[i];
        element.style.borderColor = "#73879C";
    }

    var btnCoverList = document.getElementsByClassName('btn-cover-toggle');
    if(btnCoverList.length >= 2){
        for(var i = 0; i < btnCoverList.length; i++){
            var element = btnCoverList[i];
            if(element.innerHTML === "Undo"){
                element.style.borderColor = "#73879C";

                var tmpId = (element.id).split('_');
                var deleteBtnId = tmpId[0] + "_btn_delete";
                $("#" + deleteBtnId).removeAttr('disabled');
                document.getElementById(deleteBtnId).dataset.disabled = "false"

                // Delete hidden input value
                if($("#img_featured_changed").val() == tmpId[0]){
                    $("#img_featured_changed").val('');
                }
            }
            element.innerHTML = "Make Featured"
        }
    }

    var btnContent = $("#" + id + "_btn_toggle").html();
    var selectedEl = document.getElementById(id + "_img");
    if(btnContent == "Make Featured"){
        selectedEl.style.borderColor = "red";
        $("#" + id + "_btn_toggle").html("Undo");
        $("#" + id + "_btn_delete").attr('disabled','disabled');

        document.getElementById(id + "_btn_delete").dataset.disabled = "true"

        // Change hidden input value
        $("#img_featured_changed").val(id)
    }
    else{
        selectedEl.style.borderColor = "#73879C";
        $("#" + id + "_btn_delete").removeAttr('disabled');
        document.getElementById(id + "_btn_delete").dataset.disabled = "false"
        document.getElementById(id + "_btn_toggle").innerHTML = "Make Featured"
    }
}

function deleteImageEdit(id){
    var deleteBtn = $("#" + id + "_btn_delete");

    var isDisabled = deleteBtn.attr('data-disabled');

    if(isDisabled === "false"){
        var hiddenVal = $("#deleted_img_id").val();
        if(hiddenVal == ''){
            $("#deleted_img_id").val(id);
        }else {
            $("#deleted_img_id").val(hiddenVal + "," + id);
        }

        $("#" + id + "_img").remove();
    }
}

// Banner
$("#link-no-opt").change(function(){
    $("#banner-url-input").show(300);
    $("#gallery-select").hide(300);
    $("#url").attr('required', true);
    $("#gallery").removeAttr('required');

    if($('#product-select').length > 0){
        $("#product-select").hide(300);
        $("#product").removeAttr('required');
    }
});

$("#link-product-opt").change(function(){
    $("#product-select").show(300);
    $("#gallery-select").hide(300);
    $("#banner-url-input").hide(300);
    $("#product").attr('required', true);
    $("#gallery").removeAttr('required');
    $("#url").removeAttr('required');
});

$("#link-gallery-opt").change(function(){
    $("#gallery-select").show(300);
    $("#banner-url-input").hide(300);
    $("#gallery").attr('required', true);
    $("#url").removeAttr('required');

    if($('#product-select').length > 0){
        $("#product-select").hide(300);
        $("#product").removeAttr('required');
    }
});

// New Order
function modalPop(id, mode, url){
    if(mode === "accept"){
        var title = "Warning";
        var content = "Apakah Anda yakin untuk menerima?"
        var yes = "Terima"

        $("#small-modal-title").html(title);
        $("#small-modal-body").html(content);
        $("#small-modal-yes").html(yes);
        $("#small-modal-yes").attr('href', url + id);
        $("#small-modal").modal();
    }
    else if(mode === "transfer"){
        var title = "Warning";
        var content = "Apakah Anda yakin untuk mengkonfirmasi?"
        var yes = "Konfirmasi"

        $("#small-modal-yes").attr("class","btn btn-success");
        $("#small-modal-title").html(title);
        $("#small-modal-body").html(content);
        $("#small-modal-yes").html(yes);
        $("#small-modal-yes").attr('href', url + id);
        $("#small-modal").modal();
    }
    else if(mode === "cancel"){
        var title = "Warning";
        var content = "Apakah Anda yakin untuk menghapus?"
        var yes = "Hapus"

        $("#small-modal-yes").attr("class","btn btn-danger");
        $("#small-modal-title").html(title);
        $("#small-modal-body").html(content);
        $("#small-modal-yes").html(yes);
        $("#small-modal-yes").attr('href', url + id);
        $("#small-modal").modal();
    }
    else if(mode === "gallery"){
        var title = "Warning";
        var content = "Apakah Anda ingin menghapus seluruh galeri dan semua gambar yang berhubungan?"
        var yes = "Hapus"

        $("#small-modal-yes").attr("class","btn btn-danger");
        $("#small-modal-title").html(title);
        $("#small-modal-body").html(content);
        $("#small-modal-yes").html(yes);
        $("#small-modal-yes").attr('href', url + id);
        $("#small-modal").modal();
    }
    else if(mode === "property-delete"){
        var title = "Warning";
        var content = "Apakah Anda ingin menghapus properti produk yang terpilih?"
        var yes = "Hapus"

        $("#small-modal-yes").attr("class","btn btn-danger");
        $("#small-modal-title").html(title);
        $("#small-modal-body").html(content);
        $("#small-modal-yes").html(yes);
        $("#small-modal-yes").attr('href', url + id);
        $("#small-modal").modal();
    }
}

function rejectModalPop(id){
    $("#reject_trx_id").val(id);
    $("#modal-reject").modal();
}

function confirmDeliveryModalPop(id, courier){
    $("#delivery-trx-id").val(id);
    $("#courier-name").html(courier);
    $("#modal-tracking-code").modal();
}

// Select2
$('#product').select2({
    placeholder: 'Pilih Produk',
    allowClear: true
});