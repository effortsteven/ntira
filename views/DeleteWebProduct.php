<?php


namespace System\views;
use Config\GlobalView;
use Controllers\WebProduct;

class DeleteWebProduct extends GlobalView
{
    public function get($request,$response){
        WebProduct::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}