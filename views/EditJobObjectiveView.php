<?php


namespace System\views;
use Config\GlobalView;
use Controllers\JobObjective;

class EditJobObjectiveView extends GlobalView
{
    public static function post($request,$response)
    {
        try{
            JobObjective::update_job_objective($request->id,$_POST['description']);
            $data=[
                "status"=>true
            ];
        }catch (\Exception $e){
            $data=[
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}