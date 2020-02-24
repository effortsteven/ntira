<?php


namespace System\views;
use Config\GlobalView;
use Controllers\GalleryPhoto;

class DeleteGalleryphotoView extends GlobalView
{
    public function get($request,$response){
        GalleryPhoto::delete($request->id);
        $data = [
            "status"=>true,
            "message"=> "Successfully Removed"
        ];
        $send = $request->param("format","json");
        return $response->$send([$data]);
    }
}