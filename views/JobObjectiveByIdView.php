<?php


namespace System\views;
use Config\GlobalView;
use Controllers\JobObjective;

class JobObjectiveByIdView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['jobobjective']=[];
        foreach (JobObjective::get_one_objectives($request->id) as $row){
            $info = [
                "pk"=>$row['id'],
                "career_id"=>$row['career_id'],
                "description"=>$row['description'],
                "is_active"=>$row['is_active']
            ];
            array_push($data['jobobjective'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}