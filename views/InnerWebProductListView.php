<?php


namespace System\views;
use Config\GlobalView;
use Controllers\InnerProduct;

class InnerWebProductListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=> true
        ];
        $data['inner_web_products'] = [];
        foreach (InnerProduct::all_inner_product($request->id) as $row){
            $info = [
                "pk" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "link" => $row['link'],
                "images" => parent::static_url($row['images']),
            ];
            array_push($data['inner_web_products'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            $data = [
                "status"=>true
            ];
        }catch (\Exception $e){
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}