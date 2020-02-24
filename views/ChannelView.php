<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Channel;

class ChannelView extends GlobalView
{
    public function get($request, $response){
        $data = [];
        foreach (Channel::all_channel() as $row){
            $info = [
                "status"=>true,
                "pk" => $row['id'],
                "name" => $row['name'],
            ];
            $data = $info;
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            Channel::create_channel($_POST['name']);
            $data = [
                "status"=>true
            ];
        }catch (\Exception $e){
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}