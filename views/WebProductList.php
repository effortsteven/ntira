<?php


namespace System\views;
use Config\GlobalView;
use Controllers\WebProduct;

class WebProductList extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true,
        ];
        $data['webproducts'] = [];
        foreach (WebProduct::all_web_products() as $row){
            if ($row['has_child'] == 1){
                $has_child = true;
            }else{
                $has_child = false;
            }
            $info = [
                "pk" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "link" => $row['link'],
                "product_type" => $row['product_type'],
                "has_child" => $has_child,
                "is_active" => $row['is_active']
            ];
            array_push($data['webproducts'],$info);
        }
        http_response_code(200);
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}