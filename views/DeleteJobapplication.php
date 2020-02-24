<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Application;

class DeleteJobapplication extends GlobalView
{
    public function get($request,$response){
        Application::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}