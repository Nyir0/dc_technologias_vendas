<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sell;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    // Aqui será executado uma simulacao que irá trazer o valor total dos produtos
    function Simulate(Request $request){
        $list = $this->getList($request->all());
        
        $total = 0;

        foreach($list as $value){
            $amount = floatval(str_replace(',', '.', $value['value']))*floatval(str_replace(',', '.', $value['amount']));
            $total += floatval(str_replace(',', '.', $amount));
        }

        $list['total'] = number_format($total, 2, ',', '.');

        return $list;

    }

    function Sell(Request $request){

        //Criando a instacia para pegar uma string com HTML
        $crawler = new Crawler($request->listProducts);
        // Convertendo a string com HTML para sem tags HTML
        $text = $crawler->filterXPath('//text()');

        $list_products = "";
        foreach ($text as $index){
            $list_products = $list_products . $index->nodeValue;
        }

        // Filtra e faz a limpeza do texto de lista de produtos
        $stringLimpa = preg_replace('/\s+/', ' ', $list_products);
        $palavrasSeparadas = preg_replace('/\s+/', ', ', trim($stringLimpa));
        $JSON_list_products = $palavrasSeparadas;

        // Valor total da venda
        $total = floatVal(str_replace(',','.',$request->total[0]));

        // Tipo de pagamento
        $type_payments = $request->payments;

        // Número de Parcelas
        $installments = $request->parcel;

        $BD_Sells = new Sell;
        $BD_Sells->id_user      =   Auth::id(); 
        $BD_Sells->products     =   $JSON_list_products;
        $BD_Sells->total_value  =   $total;
        $BD_Sells->type_payment =   $type_payments;
        $BD_Sells->installments =   $installments;
        $BD_Sells->save();
        return "success";
    }

    // Função que direciona para a pagina de historico e mostra todas as compras feitas
    function history(){
        $history = Sell::where("id_user","=", Auth::id())->get();

        return view("history", ["history" => $history]);
    }

    // Função para pegar os valores e formatar, do formulario de produtos que serão vendidos, e retorna um array
    public function getList($array){
        $list = [];
        
        foreach($array as $key => $value){
            $line = explode("_", $key);
            switch ($line[0]) {
                case 'product':
                    $list["product_".$line[1]]["product"] = $value;
                    break;
                case 'value':
                        $list["product_".$line[1]]["value"] = $value;
                        break;
                case 'amount':
                    $list["product_".$line[1]]["amount"] = $value;
                    break;
                default:
                    break;
            }
        }

        return $list;
    }

    function SellClose(Request $request){
        $sell_id = str_replace("seller", '', $request->sell_id);
        Sell::where("id", "=", $sell_id)->delete();
    }

    function editHistory(Request $request){
        $sell = Sell::where("id", "=", $request->id)->first();

        return view("edit_history", ["sell" => $sell]);
    }

    function edit(Request $request){
        Sell::where("id", "=", $request->id)
        ->update([
            'products' => $request->products,
            'total_value' => floatVal(str_replace(',', '.',$request->totalShell)),
            'installments' => $request->parcel,
            'type_payment' => $request->paymentOption
        ]);

        return redirect()->route('history');
    }
}
