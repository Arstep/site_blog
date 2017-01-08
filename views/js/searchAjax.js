$(document).ready(function(){
    $('#search_button').bind('click', searchText);
});


/*Поиск по статьям на сайте*/
function searchText () {
    var string = $('#search_data').val();

    if (string){

        /*Количество символов в поисковой строке*/
        if (string.length < 3) return;

        data = 'data=' + string;

        $.ajax({
            type: "POST",
            url: "/index/findajax",
            data: data,
            success: function (result)
            {
                $('#showajax').html(result);
            }
        })
    }
}
