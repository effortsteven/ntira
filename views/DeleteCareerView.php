<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Career;

class DeleteCareerView extends GlobalView
{
    public function get($request,$response){
        Career::delete_career($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}