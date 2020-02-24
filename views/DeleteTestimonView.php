<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Testimon;

class DeleteTestimonView extends GlobalView
{
    public function get($request,$response){
        try{
            Testimon::delete_testimon($request->id);
            $data = [
                "status"=>true,
                "message"=> "Successfully Removed"
            ];
        }catch (\Exception $e){
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}