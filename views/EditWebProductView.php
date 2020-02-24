<?php


namespace System\views;
use Config\GlobalView;
use Controllers\WebProduct;
use Config\Core\FileManager;

class EditWebProductView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true,
        ];
        $data['webproducts'] = [];
        $data['webproducts_all'] = [];
        if(isset($_GET['product_id'])){
            foreach (WebProduct::get_web_product($_GET['product_id']) as $row){
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
                    "images" => parent::static_url($row['images']),
                    "product_type" => $row['product_type'],
                    "has_child" => $has_child,
                    "is_active" => $row['is_active']
                ];
                array_push($data['webproducts'],$info);
            }
        }
        foreach (WebProduct::all_web_products() as $row){
            if ($row['has_child'] == 0){
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
            array_push($data['webproducts_all'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
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
            error_log($_POST['has_child'],4);
            if ($_POST['has_child'] == "True"){
                $has_child = true;
            }else if($_POST['has_child'] == "False"){
                $has_child = false;
            }
            WebProduct::update_news_web_product($_POST['product_id'],$_POST['title'],$_POST['description'],$_POST['link'],$images,(int)$_POST["product_type"],$has_child);
            $data = [
                "status"=>true,
            ];
        }catch (\Exception $e){
            error_log($e->getMessage(), 4);
            $data = [
                "status"=>false,
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}