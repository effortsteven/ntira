<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\Gallery;
use Controllers\GalleryPhoto;

class EditGalleryView extends GlobalView
{
    public function post($request,$response){
        try{

            if (isset($_POST['video_path'])){
                $video_path = $_POST['video_path'];
            }else{
                $video_path = "";
            }
            if (isset($_POST['is_ads'])){
                if ($_POST['is_ads'] == "on"){
                    $is_ads = 1;
                }else{
                    $is_ads = 0;
                }
            }else{
                $is_ads = 0;
            }
            Gallery::update_gallery($_POST['gallery_id'],$_POST['title'],$_POST['description'],$video_path, $is_ads);
            $gallery = Gallery::get_gallery_by_title($_POST['title']);
            if (isset($_FILES['gallery_photos'])){
//                error_log($_FILES['gallery_photos']['name'],4);
                $file_name = FileManager::uploadSingleFile("gallery_photos","gallery_photos");
                if ($gallery){
                    GalleryPhoto::create_gallery_photo($file_name, $gallery[0]['id']);
                }else{
                    GalleryPhoto::update_gallery($file_name, $gallery[0]['id']);
                }
            }
            $data = [
                "status"=>true
            ];
        }catch(\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}