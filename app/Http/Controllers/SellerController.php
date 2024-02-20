<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
