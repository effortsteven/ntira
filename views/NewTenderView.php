<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\Tender;

class NewTenderView extends GlobalView
{
    public function post($request,$response){
        try{
            if (isset($_FILES['file_name'])){
                $file_name = FileManager::uploadSingleFile("tender_images",'file_name');
            }else{
                $file_name = "";
            }
            Tender::create_tender($_POST['tender_number'],$_POST['tender_category'],$_POST['tender_description'],$_POST['eligible_firm'],$_POST['method_of_procurement'],$_POST['deadline'],$_POST['date_of_publish'],$file_name,$_POST['document_price'],$_POST['code_number']);
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
        $response->$send([$data]);
    }
}