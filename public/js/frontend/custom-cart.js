
function showAddtoCartForm(e, startDate, price, listPrices){
    $("#package-id").val(e);
    $("#list-prices").val(listPrices);
    $("#price-form").val(price);

    // var onlyThisDates = ['12/2/2019', '13/2/2019', '14/2/2019'];
    var onlyThisDates = startDate.split(",");
    var dateArr = [];
    for(var a=0; a<onlyThisDates.length; a++){
        var convertDate = moment(onlyThisDates[a], 'DD MMM YYYY').format('DD M YYYY');
        // alert(convertDate);
        dateArr.push(convertDate)
    }
    $('#start_date').datepicker({
        format: "dd M yyyy",
        startDate : dateArr[0],
        autoclose: true,
        beforeShowDay: function (date) {
            var dt_ddmmyyyy = date.getDate() + ' ' + (date.getMonth() + 1) + ' ' + date.getFullYear();
            // alert(dt_ddmmyyyy);
            if (dateArr.indexOf(dt_ddmmyyyy) != -1) {
                return {
                    tooltip: 'Select Date',
                    classes: 'active'
                };
            } else {
                return false;
            }
            // if ($.inArray(date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate(), dateArr) !== -1)
            // {
            //     return;
            // }
            //
            // return false;
        }
    });

    $("#myModalForm").modal();
}

function editParticipant(){
    var participant = $("#participant").val();
    var listPrices = JSON.parse($("#list-prices").val());
    var price = $("#price-form").val();
    for(var a=0; a<Object.keys(listPrices).length; a++){
        if(participant > listPrices[a].quantity){
            price = listPrices[a].price;
        }
    }
    var totalPrice = participant * price;
    totalPrice = totalPrice.toLocaleString(
        "de-DE"
    );
    $("#total-price").text(totalPrice);
}

function addToCart(addUrl, csrf){
    var packageId = $("#package-id").val();
    var participant = $("#participant").val();
    var notes = $("#notes").val();
    var start_date = $("#start_date").val();
    // alert(start_date);
    $.ajax({
        type: 'POST',
        url: addUrl,
        data: {
            '_token': csrf,
            'id': packageId,
            'participant': participant,
            'start_date': start_date,
            'notes': notes
        },
        success: function(data) {
            if ((data.errors)){
                // alert("errors");
                var url = "/login-traveller";

                window.location = url;
            }
            else{
                // alert("success");
                $("#myModalForm").hide();
                $("#myModal").modal();
            }
        },
        error : function(msg){
          //   var asdf = JSON.stringify(msg);
          // alert(asdf);
        }
    });
}