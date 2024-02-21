<x-app-layout>
    <div class="pb-5">
        @csrf
        @foreach($history as $sell)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
            <section class="flex flex-col relative text-white flex w-full p-8 mb-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <img name="close-history" value={{"seller".$sell->id}} class="absolute right-1 top-1 cursor-pointer" src="icons/close.svg" alt="" width="25">
                <table class="w-full">
                    <tr>
                        <th class="w-2/6">Produtos</th>
                        <th class="w-1/6">Total</th>
                        <th class="w-1/6">Tipo Pagamento</th>
                        <th class="w-1/6">Parcelas</th>
                        <th class="w-1/6">Data Venda</th>
                    </tr>
                    <tr>
                        <td class="w-2/6">{{$sell->products}}</td>
                        <td class="w-1/6">R$ {{number_format($sell->total_value,2 ,',', '.')}}</td>
                        <td class="w-1/6">{{$sell->type_payment}}</td>
                        <td class="w-1/6">{{$sell->installments}}</td>
                        <td class="w-1/6">{{date("d/m/Y - H:i", strtotime($sell->created_at))}}</td>
                    </tr>
                </table>
                <a class="mt-5" href={{"/edit-history/".$sell->id}}>Editar</a>
            </section>
        </div>
        @endforeach
    </div>
</x-app-layout>