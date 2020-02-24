<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Application;
use Controllers\JobObjective;


class JobApplicationListView extends GlobalView
{
    public static function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['application_list']=[];
        foreach (Application::all_application_career($request->id) as $row){
            $info = [
                "pk"=>$row['id'],
                "full_name"=>$row['full_name'],
                "career_id"=>$row['career_id'],
                "dob"=>$row['dob'],
                "postal_address"=>$row['postal_address'],
                "place_of_birth"=>$row['place_birth'],
                "nationality"=>$row['nationality'],
                "marital_status"=>$row['marital_status'],
                "phone"=>$row['phone'],
                "others"=>$row['others']
            ];
            array_push($data['application_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            JobObjective::create_job_objective($_POST['career_id'],$_POST['description']);
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