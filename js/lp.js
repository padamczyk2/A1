$( document ).ready(function() {
    $("#modal-content").hide();
    $("#modal").hide();
    $("#subscribe").click(function () {
        $.ajax({
            type: "GET",
            url: 'http://octadecimal.pl',
            data: {
                'firstname': $('#firstname').val(),
                'lastname' : $('#lastname').val(),
                'email': $('#email').val(),
            },
            contentType: 'application/json',
            dataType: 'jsonp',
            success: function(result){
                $("#modal-content").show();
                $("#modal").show();
            },
            error: function(result) {
                console.log(result);
                //alert(result.message);
            },
        })
    });
});