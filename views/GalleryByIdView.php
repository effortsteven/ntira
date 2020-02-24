<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Gallery;
use Controllers\GalleryPhoto;

class GalleryByIdView extends GlobalView
{
    public function get($request,$response){
        $data=[
            "status"=>true
        ];
        $data['gallery'] = [];
        foreach (Gallery::get_gallery($request->id) as $row){
            $info = [
                "pk"=> $row['id'],
                "title"=>$row['title'],
                "description"=> $row['description'],
                "video_path"=> $row['video_path'],
                "is_ads"=> $row['is_ads']
            ];
            $info['gallery_photos'] = [];
            foreach (GalleryPhoto::all_gallery_photo($row['id']) as $row){
                $info1 = [
                    "pk"=>$row['id'],
                    "image_path"=> parent::static_url($row['image_path'])
                ];
                array_push($info['gallery_photos'],$info1);
            }
            array_push($data['gallery'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}