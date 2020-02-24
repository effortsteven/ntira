<?php


namespace System\views;
use Config\GlobalView;
use Controllers\JobObjective;

class DeleteJobObjectiveView extends GlobalView
{
    public function get($request,$response){
        JobObjective::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}