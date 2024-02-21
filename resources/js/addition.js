import $ from 'jquery';

var contador = 2;

$(window).on('load', () => {
    
    $("#addition").on("click", function() {
        
        $("#add_minus").before(
            `
            <section class="flex w-full p-8 mb-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col w-2/5">
                    <label>Produto</label>
                    <input class="uppercase" type="text" id="product_${contador}" name="product_${contador}" placeholder="Digite o nome um dos produtos" required>
                </div>
                <div class="flex flex-col w-2/5 mx-4">
                    <label>Valor</label>
                    <input class="uppercase moedaBR" type="text" id="value_${contador}" name="value_${contador}" placeholder="Digite o valor do produto" required>
                </div>
                <div class="flex flex-col w-1/5">
                    <label>Quantidade</label>
                    <input class="uppercase" type="number" id="amount_${contador}" name="amount_${contador}" placeholder="Digite a Quantidade" required>
                </div>
            </section>
            `
        )
        contador++;
    })

    $("#minus").on("click", function() {
        // Seleciona todos os sections dentro do formulário
        var sections = $("#formSell section");
    
        console.log(sections.length);
        // Verifica se há pelo menos um section antes de remover
        if (sections.length > 1) {
            // Seleciona o último section e o remove
            sections.eq(sections.length - 1).remove();
        }
    });
})