<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Gallery;

class DeleteGalleryView extends GlobalView
{
    public function get($request,$response){
        Gallery::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}