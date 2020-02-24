<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Testimon;

class NewTestimonApi extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=> true
        ];
        $data['testmons_list'] = [];
        foreach (Testimon::get_all_testimon() as $row){
            $info = [
                "pk" => $row['id'],
                "image" => $row['image'],
                "company_description" => $row['company_description'],
                "customer_description" => $row['customer_description'],
                "customer_name" => $row['customer_name'],
            ];
            array_push($data['testmons_list'],$info);
        }
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            if (isset($_FILES['image'])){
                $image = parent::upload_file("testimon_images",$_FILES['image'])[1];
            }else{
                $image = "";
            }
            Testimon::create_testimon($image,$_POST["company_description"], $_POST["customer_description"],$_POST['title']);
            $data = [
                "status"=>true
            ];
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        return $response->$send($data);
    }
}