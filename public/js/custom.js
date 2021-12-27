
function myFunction() {
    var input, filter, table, tr, td, cell, i, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) {
        // Hide the row initially.
        tr[i].style.display = "none";

        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            cell = tr[i].getElementsByTagName("td")[j];
            if (cell) {
                if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}

$(document).ready(function() {
    var country_id =  $('#country').find(":selected").attr('data-id');
    changeCity(country_id);
    $('#country').on('change', function() {
        var country_id = $(this).find(":selected").attr('data-id');
        changeCity(country_id);
    });
    function changeCity(country_id) {

        $("#city").html('<option >Select City</option>');
        $.ajax({
            url:"/get-cities-by-country",
            type: "POST",
            data: {
                country_id: country_id,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                var old_city = $("#old_city").val();
                $.each(result.cities,function(key,value){
                    if(old_city == value.name){
                        $("#city").append('<option value="'+value.name+'" selected>'+value.name+'</option>');
                    }else{
                        $("#city").append('<option value="'+value.name+'">'+value.name+'</option>');
                    }

                });
            }
        });
    }
});
