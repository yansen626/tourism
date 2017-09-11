$('#order-table').DataTable({
    "info": false,
    "ordering": false,
    "searching": false,
    "lengthChange": false,
    "language": {
        "emptyTable": "No transactions available"
    }
});

$('.input-daterange').datepicker({
    format: "dd/mm/yyyy"
});

function orderFilter(url){
    var search = document.getElementById("search");
    if(search != null){
        document.location = url + "?start=" + $('#start').val() + "&end=" + $('#end').val() + "&search=" + $('#search').val();
    }
    else{
        document.location = url + "?start=" + $('#start').val() + "&end=" + $('#end').val();
    }
}