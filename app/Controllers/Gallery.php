<?php


namespace Controllers;
use Models\GalleryModel;

class Gallery
{
    public static function all_gallery(){
        return GalleryModel::all();
    }

    public static function all_gallery_current(){
        return GalleryModel::query()->where("is_ads",1)->get();
    }

    public static function get_gallery($pk){
        return GalleryModel::query()->where("id",$pk)->get();
    }

    public static function get_gallery_by_title($title){
        return GalleryModel::query()->where("title",$title)->get();
    }

    public static function create_gallery($title="",$description="",$video_path="",$is_ads=""){
        return GalleryModel::create(["title"=>$title,"description"=>$description,"video_path"=>$video_path,"is_ads"=>$is_ads]);
    }

    public static function update_gallery($pk,$title="",$description="",$video_path="",$is_ads=""){
        GalleryModel::query()->where("id",$pk)->update(["title"=>$title,"description"=>$description,"video_path"=>$video_path,"is_ads"=>$is_ads]);
    }

    public static function delete($pk)
    {
        GalleryModel::query()->where("id", $pk)->delete();
    }
}