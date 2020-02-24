<?php


namespace System\views;
use Config\GlobalView;
use Controllers\InnerProduct;
use Config\Core\FileManager;

class EditInnerWebProductView extends GlobalView
{
    public function post($request,$response){
        try{
            if (isset($_FILES['images'])){
                $images = FileManager::uploadSingleFile("inner_web_product_images","images");
            }else{
                if (isset($_POST['images_clear'])){
                    if ($_POST['images_clear'] == "on"){
                        $images = "";
                    }else{
                        $images = InnerProduct::get_inner_product($request->id)[0]['images'];
                    }
                }else{
                    $images = InnerProduct::get_inner_product($request->id)[0]['images'];
                }
            }
            InnerProduct::update_inner_product($request->id,$_POST['title'],$_POST['description'],$_POST['link'],$images);
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