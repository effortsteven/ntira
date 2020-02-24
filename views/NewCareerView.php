<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\Career;

class NewCareerView extends GlobalView
{
    public function post($request,$response){
        try{
            if (isset($_FILES['file_name'])){
               $file_name = FileManager::uploadSingleFile("career_files","file_name");
            }else{
                $file_name = "";
            }
            Career::create_career($_POST['job_title'],$_POST['position'],$_POST['experience'],$file_name);
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