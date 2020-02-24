<?php


namespace System\views;
use Config\GlobalView;
use Controllers\InnerProduct;

class DeleteInnerWebProductView extends GlobalView
{
    public function get($request,$response){
        InnerProduct::delete_inner_product($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}