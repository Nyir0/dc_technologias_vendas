import $ from 'jquery';

$(window).on('load', () => {
    
    $("img[name='close-history']").on("click", function() {
        var sell_id = $(this).attr('value');
        $.ajax({
            type: "POST",
            url: "/sell-close",
            data:{
                "_token"  : $("input[name='_token']").val(),
                "sell_id": sell_id
            },
            dataType:"json"
        })
        window.location.reload();
    });

    $("#editHistory").on("click", () => {
        console.log("editar");
    })

})