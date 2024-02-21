import $ from 'jquery';

$(window).on("load", () => {
    // Esta requisicao retorna o valor total dos produtos e quantidades inseridos
    $("#formSell").on("submit", (e)=>{
        e.preventDefault();

        $.ajax({
            url: "/api/simulacao-compra",
            type: "get",
            data:$("#formSell").serialize(),
            datatype: "json",
            success: (data)=>{
                $("#totalSell").text("Total: R$ " + data.total);
                $("#valueParcel").text("");
                $("#listProducts").empty()
                var array = Object.values(data);

                array.forEach(element => {
                    if(element.product){
                        $("#listProducts").append(`
                            <span>x${element.amount}_${element.product.replace(/ /g, '_')}</span>
                        `)
                    }
                });
            },
            error: () => {
                console.log("Algo deu errado");
            }
        })

        $("#paymentSection").css("opacity", "1");
    })

    // Esta parte irá ser executada quando o cliente confirmar a compra e irá inserir no banco de dados
    $("#formFinish").on("submit", (e) => {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/sell",
            data:{
                "_token"        : $("input[name='_token']").val(),
                "total"         : $("#totalSell").text().match(/\d+\,\d+(\.\d+)?/),
                "payments"      : $("#paymentOption").val(),
                "parcel"        : $("#parcel").val(),
                "listProducts"  : $("#listProducts").html()
            },
            dataType: "json"
        })

        window.location.href = "/history";
    })

    $("#paymentOption").on("change", () => {
        if($("#paymentOption").val() === "cred"){
            $("#parcel").prop("disabled", false);
        }else{
            $("#parcel").val("1");
            $("#parcel").prop("disabled", true);
            $("#valueParcel").empty();
        }
    })

    $("#parcel").on("change", (e) => {
    
        var valor = $("#totalSell").text(); 
        var resultado = valor.match(/\d+\,\d+(\.\d+)?/);

        var valorFloat = resultado[0];
        var parcel = parseInt($("#parcel").val()); 
        if (parcel !== 0) {
            var valueParcel = parseFloat(valorFloat.replace(",", ".")) / parcel;
            $("#valueParcel").text("R$ " + valueParcel.toFixed(2) + " cada Parcela");
        }
    });
})