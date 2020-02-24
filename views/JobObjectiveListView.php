<?php


namespace System\views;
use Config\GlobalView;
use Controllers\JobObjective;

class JobObjectiveListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['jobobjective_list']=[];
        foreach (JobObjective::all_objectives($request->id) as $row){
            $info = [
                "pk"=>$row['id'],
                "career_id"=>$row['career_id'],
                "description"=>$row['description'],
                "is_active"=>$row['is_active']
            ];
            array_push($data['jobobjective_list'],$info);
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