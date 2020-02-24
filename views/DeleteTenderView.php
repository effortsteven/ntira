<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Tender;

class DeleteTenderView extends GlobalView
{
    public function get($request,$response){
        try{
            Tender::delete_tender($request->id);
            $data=[
                "status"=>true,
                "message"=>"Successfully Created"
            ];
        }catch (\Exception $e){
            $data=[
                "status"=>false,
                "message"=>"Failed to Create"
            ];
        }
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}