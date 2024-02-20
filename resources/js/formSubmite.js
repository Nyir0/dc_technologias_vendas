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
            },
            error: () => {
                console.log("Algo deu errado");
            }
        })

        $("#paymentSection").css("opacity", "1");
    })

    $("#parcel").on("change", (e) => {
    
        var valor = $("#totalSell").text(); 
        var resultado = valor.match(/\d+\,\d+(\.\d+)?/);

        var valorFloat = resultado[0];
        var parcel = parseInt($("#parcel").val()); 
        if (parcel !== 0) {
            var valueParcel = parseFloat(valorFloat.replace(",", ".")) / parcel;
            $("#valueParcel").text("R$ " + valueParcel.toFixed(2) + " cada Parcela");
        } else {
            $("#valueParcel").text("Número de parcelas deve ser maior que zero");
        }
    });

    // Esta parte irá ser executada quando o cliente confirmar a compra e irá inserir no banco de dados
    $("#formFinsh").on("submit", (e) => {
        e.preventDefault(e);
    })
})