<?php

namespace App\Http\Controllers;

use App\Http\Models\ProductModel;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    function index(ProductModel $produto){
       return $produto->all();
    }

    function show(ProductModel $produto){
       return $produto;
    }

    public function getProdutosXtech(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fernando-oliveira.xtechcommerce.com/api-v1/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",

            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-KEY: c9f0d46f9ba3f7fdcab1098bb0389954",
                "X-APP-KEY: jup8uJAphug5zAv2NuteyakukazEre",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response);
        print_r($data[0]);exit;

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            if(isset(json_decode($response)->error)){
                return response()->json(json_decode($response,true), 401);
            }else{
                return response()->json(json_decode($response,true), 200);
            }
        }
    }

    public function getProdutoXtech(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fernando-oliveira.xtechcommerce.com/api-v1/products?id=4270403",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_CONNECTTIMEOUT => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 0,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",

            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-KEY: c9f0d46f9ba3f7fdcab1098bb0389954",
                "X-APP-KEY: jup8uJAphug5zAv2NuteyakukazEre",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = (Object)json_decode($response,true);
//        $data = (Object)['id'=>'teste'];

        print_r($data->id);exit;
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            if(isset(json_decode($response)->error)){
                return response()->json(json_decode($response,true),401);
            }else{
                return response()->json(json_decode($response,true),200);
            }
        }
    }

    function store(Request $request, ProductModel $produto){
        $data = $produto->create($request->all());
        return $data;
    }

    function update(Request $request, ProductModel $produto){
        $produto->update($request->all());
        return $produto;
    }

    public function destroy(ProductModel $produto){
        $produto->delete();
        return $produto;
    }

}
