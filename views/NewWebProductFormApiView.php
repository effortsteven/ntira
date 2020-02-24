<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\WebProduct;

class NewWebProductFormApiView extends GlobalView
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
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }

    public function post($request, $response){
        try{
            if (isset($_FILES['images'])){
                error_log("1", 4);
                $images = FileManager::uploadSingleFile("web_products",'images');
            }else{
                if (isset($_POST['images_clear'])){
                    if ($_POST['images_clear'] == "on"){
                        error_log("2", 4);
                        $images = "";
                    }else{
                        error_log("3", 4);
                        $images = WebProduct::get_web_product($_POST['product_id'])[0]['images'];
                    }
                }else{
                    error_log("4", 4);
                    $images = WebProduct::get_web_product($_POST['product_id'])[0]['images'];
                }
            }
            if ($_POST['has_child']=="on"){
                $has_child = true;
            }else{
                $has_child = false;
            }

            if (isset($_POST['description'])){
                $description = $_POST['description'];
            }else{
                $description = "";
            }
            WebProduct::create_web_product($_POST['title'],$description,$_POST['link'],$images,$_POST['product_type'],$has_child);
            $data = [
                "status"=>true,
            ];
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false,
            ];
        }
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}