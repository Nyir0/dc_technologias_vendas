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
    // Esta parte irá ser executada quando o cliente confirmar a compra e irá inserir no banco de dados
    $("#formFinsh").on("submit", (e) => {
        e.preventDefault(e);
    })
})