<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
        <section class="flex flex-col relative text-black flex w-full p-8 mb-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="post" action="/edit" class="w-1/2">
                @csrf
                <input class="hidden" type="text" name="id" value={{$sell->id}}>
                <div class="flex flex-col mb-5">
                    <label for="products">Produtos</label>
                    <textarea class="text-black" name="products" id="products" cols="30" rows="10">
                        {{str_replace(' ', '', $sell->products)}}
                    </textarea>
                </div>
                <div>
                    <label for="totalSell">Total (R$)</label>
                    <input id="totalSell" name="totalShell" class="font-semibold text-5xl text-gray-800 dark:text-gray-200 leading-tight" value={{number_format($sell->total_value,2,',','.')}}>
                </div>
                <div class="flex flex-col my-5">
                    <label for="paymentOption">Escolha a forma de pagamento:</label>
                    <select class="w-2/3 p-2 my-2" id="paymentOption" name="paymentOption">
                        <option value="pix" @if($sell->type_payment == "pix") selected @endif>PIX</option>
                        <option value="deb" @if($sell->type_payment == "deb") selected @endif>Debito</option>
                        <option value="cred" @if($sell->type_payment == "cred") selected @endif>Credito</option>
                        <option value="bol" @if($sell->type_payment == "bol") selected @endif>Boleto</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="parcel">Parcelas:</label>
                    <div class="flex items-center mb-5">
                        <select class="w-1/7 p-2 my-2" id="parcel" name="parcel">
                            <option value="1" @if($sell->installments == "1") selected @endif>A vista</option>
                                <option value="2" @if($sell->installments == "2") selected @endif>2x</option>
                                <option value="3" @if($sell->installments == "3") selected @endif>3x</option>
                                <option value="4" @if($sell->installments == "4") selected @endif>4x</option>
                                <option value="5" @if($sell->installments == "5") selected @endif>5x</option>
                                <option value="6" @if($sell->installments == "6") selected @endif>6x</option>
                                <option value="7" @if($sell->installments == "7") selected @endif>7x</option>
                                <option value="8" @if($sell->installments == "8") selected @endif>8x</option>
                                <option value="9" @if($sell->installments == "9") selected @endif>9x</option>
                                <option value="10" @if($sell->installments == "10") selected @endif>10x</option>
                                <option value="11" @if($sell->installments == "11") selected @endif>11x</option>
                                <option value="12" @if($sell->installments == "12") selected @endif>12x</option>
                        </select>
                    </div>
                    <x-primary-button id="editHistory" class="w-40 justify-center">Editar</x-primary-button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>