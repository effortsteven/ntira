<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Tender;
use Config\Core\FileManager;

class EditTenderView extends GlobalView
{
    public function post($request,$response){
        try{
            if (isset($_FILES['file_name'])){
                $file_name = FileManager::uploadSingleFile("tender_images",'file_name');
            }else{
                if (isset($_POST['file_name_clear'])){
                    if ($_POST['file_name_clear'] == "on"){
                        $file_name = "";
                    }else{
                        $file_name = Tender::all_tender_by_id($request->id)[0]['file_name'];
                    }
                }else{
                    $file_name = Tender::all_tender_by_id($request->id)[0]['file_name'];
                }
            }
            Tender::update_tender($_POST['tender_id'],$_POST['tender_number'],$_POST['tender_category'],$_POST['tender_description'],$_POST['eligible_firm'],$_POST['method_of_procurement'],$_POST['deadline'],$_POST['date_of_publish'],$file_name,$_POST['document_price'],$_POST['code_number']);
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
        return $response->$send([$data]);
    }
}