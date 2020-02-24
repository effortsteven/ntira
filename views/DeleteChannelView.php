<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Channel;

class DeleteChannelView extends GlobalView
{
    public function get($request,$response){
        Channel::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}