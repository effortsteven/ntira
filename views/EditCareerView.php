<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\Career;

class EditCareerView extends GlobalView
{
    public function post($request,$response){
        try{
            if (isset($_FILES['file_name'])){
                $file_name = FileManager::uploadSingleFile("career_files","file_name");
            }else{
                if (isset($_POST['file_name_clear'])){
                    if ($_POST['file_name_clear'] == "on"){
                        $file_name = "";
                    }else{
                        $file_name = Career::get_one_career($request->id)[0]['file_name'];
                    }
                }else{
                    $file_name = Career::get_one_career($request->id)[0]['file_name'];
                }
            }
            Career::update_career($request->id,$_POST['job_title'],$_POST['position'],$_POST['experience'],$file_name);
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