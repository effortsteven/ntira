<?php


namespace System\views;
use Config\GlobalView;
use Controllers\InnerProduct;
use Config\Core\FileManager;

class InnerWebProductById extends GlobalView
{
    public function get($request,$response){
        $data=[
            "status"=>true
        ];
        $data['inner_web_product'] = [];
        foreach (InnerProduct::get_inner_product($request->id) as $row){
            $info = [
                "pk" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "link" => $row['link'],
                "images" => parent::static_url($row['images']),
                "product_id" => $row['product_id']
            ];
            array_push($data['inner_web_product'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            if (isset($_FILES['images'])){
                $images = FileManager::uploadSingleFile("inner_web_product_images","images");
            }else{
                $images = "";
            }
            InnerProduct::create_inner_product($request->id,$_POST['title'],$_POST['description'],$_POST['link'],$images);
            $data = [
                "status"=>true
            ];
        }catch(\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}