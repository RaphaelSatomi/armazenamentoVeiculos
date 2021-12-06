<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Carros;

class ApiPostController extends Controller
{
    public function getParam( $pattern){
        preg_match_all($pattern, $GLOBALS["content"], $match);
        return array_map('trim', $match[ 1 ]);
    }

    public function add(Request $request)
    {
        $array = ['error' => ''];

        function saveCars( $itensFichaTecnica, $cars ){
            $id = getParam('/card clearfix" id="(.*?)"/');                                      // id 
            $name = getParam('/\/[0-9]*">(.*?)</');                                             // nome_veiculo 
            $link = getParam('/card__title ui-title-inner"><a href="(.*?)"/');                  // link 
            $fichaTecnica = array_chunk( getParam('/card-list__info">([\w\s]+.*?)</'), 6 );     // ficha tecnica
            $img = getParam('/<img width="827" height="593" src="(.*?)"/');
            $price = getParam('/class="card__price-number">(.*?)</');
        
        
            for( $i = 0; $i < sizeof($link); $i++ ){
                $temp = [];
                $temp["img"] = $img[ $i ];
                $temp["user_id"] = $id[ $i ];
                $temp["nome_veiculo"] = $name[ $i ];
                $temp["link"] = $link[ $i ];
                $temp["price"] = $price[ $i ];
        
                for( $j = 0; $j < sizeof($itensFichaTecnica); $j++ ){
                    $temp[ $itensFichaTecnica[$j] ] = $fichaTecnica[$i][$j];
                }
                array_push( $cars, $temp );
                
            }
            return $cars;
        }

        if( (null == $request->input('busca')) || $request->input('busca') == ""){
            $array['error'] = "Erro no termo digitado! Tente Novamente";
            return $array;
        }

        $title = $request->input('busca');
        function getParam( $pattern){
            preg_match_all($pattern, $GLOBALS["content"], $match);
            return array_map('trim', $match[ 1 ]);
        }
    
        // $GLOBALS["content"] = file_get_contents("https://www.questmultimarcas.com.br/estoque?termo=audi");
        $GLOBALS["content"] = @file_get_contents("https://www.questmultimarcas.com.br/estoque?termo=".$title);
        $cars = [];
        $itensFichaTecnica = [
            "ano", 
            "quilometragem", 
            "combustivel", 
            "cambio", 
            "portas", 
            "cor"
        ];
    
        $qtdPages = getParam('/&amp;pagina=([0-9])*"/');
        $qtdPages = sizeof($qtdPages) !== 0 ? $qtdPages[ sizeof($qtdPages) - 1] : 0;
        
        $cars = saveCars( $itensFichaTecnica, $cars );
    
        // echo "Ao todo ".sizeof($cars)." veículo(s) salvo(s) com sucesso!<br/>";

        $qtdAdd = 0;
        foreach($cars as $car){

            $verifyId = Carros::where('user_id', $car['user_id'])->count();

            if( $verifyId === 0 ){
                $carro = new Carros();

                //UserID
                $carro->user_id = $car['user_id'];

                //Nome Veiculo
                $carro->nome_veiculo = $car['nome_veiculo'];

                //Link
                $carro->link = $car['link'];
                
                //Ano 
                $carro->ano = $car['ano'];

                //Combustivel
                $carro->combustivel = $car['combustivel'];

                //Portas
                $carro->portas = $car['portas'];

                //Quilometragem
                $carro->quilometragem = $car['quilometragem'];

                //Cambio
                $carro->cambio = $car['cambio'];

                //Cor
                $carro->cor = $car['cor'];

                //Img
                $carro->img = $car['img'];

                //Preco
                $carro->preco = $car['price'];

                $carro->save();
                $qtdAdd++;
            }
        }

        if( $qtdPages > 0 ){
            //$array["msg"] = $qtdAdd." veículos salvos com sucesso na primeira página. Possui mais ".$qtdPages." páginas com o resultado de sua busca, deseja armazenalos também?";
            $array["msg"] = $qtdAdd." veículos armazenados com sucesso";
        }else if( $qtdAdd == 0 ){
            $array["msg"] = "Os veículos retornados dessa busca já estão salvos no banco de dados";
        }else{
            $array["msg"] = $qtdAdd." veículos armazenados com sucesso";
        }
        $array["list"] = $cars;
        return $array;
    }
}
