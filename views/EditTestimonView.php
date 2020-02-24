<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Testimon;
use Config\Core\FileManager;

class EditTestimonView extends GlobalView
{
   public function post($request,$response){
       try{
           if (isset($_FILES['image'])){
               $image = FileManager::uploadSingleFile("testmon_images",'image');
           }else{
               if (isset($_POST['image_clear'])){
                   if ($_POST['image_clear'] == "on"){
                       $image = "";
                   }else{
                       $image = Testimon::get_one_testimon($_POST['testmon_id'])[0]['image'];
                   }
               }else{
                   $image = Testimon::get_one_testimon($_POST['testmon_id'])[0]['image'];
               }
           }
           Testimon::update_testimon($_POST['testmon_id'],$image,$_POST['company_description'],$_POST['customer_description'],$_POST['title']);
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