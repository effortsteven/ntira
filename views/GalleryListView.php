<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Gallery;

class GalleryListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['gallery_list']=[];
        foreach (Gallery::all_gallery() as $row){
            if ($row['is_ads']){
                $is_ads = true;
            }else{
                $is_ads = false;
            }
            $info = [
                "pk"=>$row['id'],
                "title"=>$row['title'],
                "description"=>$row['description'],
                "video_path"=>$row['video_path'],
                "is_ads"=>$is_ads
            ];
            array_push($data['gallery_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}