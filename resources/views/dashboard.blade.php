<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loja') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <section class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="formSell" class="flex flex-col relative">
                        @csrf
                        <section class="flex w-full p-8 mb-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex flex-col w-2/5">
                                <label for="product">Produto</label>
                                <input class="uppercase" type="text" id="product_1" name="product_1" placeholder="Digite o nome um dos produtos" required>
                            </div>
                            <div class="flex flex-col w-2/5 mx-4">
                                <label for="product">Valor</label>
                                <input class="uppercase" type="text" step="0.01" id="value_1" name="value_1" placeholder="Digite o valor do produto" required>
                            </div>
                            <div class="flex flex-col w-1/5">
                                <label for="product">Quantidade</label>
                                <input class="uppercase" type="number" id="amount_1" name="amount_1" placeholder="Digite a Quantidade" required>
                            </div>
                        </section>
                        <div id="add_minus" class="flex">
                            <img class="cursor-pointer opacity-70 hover:opacity-100" id="addition" src="./icons/addition.svg" alt="" width="50" height="50">
                            <img class="cursor-pointer opacity-70 hover:opacity-100" id="minus" src="./icons/minus.svg" alt="" width="50" height="50">
                        </div>
                        <x-primary-button class="absolute right-0 bottom-0">Avançar</x-primary-button>
                    </form>
                </section>
                <section id="paymentSection" class="flex border-t-2 border-[dark:bg-gray-800] py-6 opacity-0 w-full transition-all duration-500 ease-linear">
                    <form id="formFinish" class="w-1/2">
                        @csrf
                        <h3 id="totalSell" class="font-semibold text-5xl text-gray-800 dark:text-gray-200 leading-tight">
                            Total: R$ 0,00
                        </h3>
                        <div class="flex flex-col">
                            <label for="paymentOption">Escolha a forma de pagamento:</label>
                            <select class="w-1/3 p-2 my-2" id="paymentOption" name="paymentOption">
                                <option value="pix">PIX</option>
                                <option value="deb">Debito</option>
                                <option value="cred">Credito</option>
                                <option value="bol">Boleto</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="parcel">Parcelas:</label>
                            <div class="flex items-center my-4">
                                <select class="w-1/7 p-2 my-2" id="parcel" name="parcel">
                                    <option value="1">A vista</option>
                                        <option value="2">2x</option>
                                        <option value="3">3x</option>
                                        <option value="4">4x</option>
                                        <option value="5">5x</option>
                                        <option value="6">6x</option>
                                        <option value="7">7x</option>
                                        <option value="8">8x</option>
                                        <option value="9">9x</option>
                                        <option value="10">10x</option>
                                        <option value="11">11x</option>
                                        <option value="12">12x</option>
                                </select>
                                <strong id="valueParcel" class="text-3xl pl-4">R$ 0,00 cada Parcela</strong>
                            </div>
                            <x-primary-button class="w-40 justify-center">Comprar !</x-primary-button>
                        </div>
                    </form>
                    <section id="listProducts" class="flex flex-col w-1/2 text-white">
                    </section>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
