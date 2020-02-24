<?php


namespace Controllers;
use Models\GalleryPhotoModel;

class GalleryPhoto
{
    public static function all_gallery_photo($pk){
        return GalleryPhotoModel::query()->where("gallery_id",$pk)->get();
    }

    public static function all_gallery_photo_with_details(){
        return GalleryPhotoModel::query()->with("gallery")->get();
    }

    public static function get_gallery_photo($pk){
        return GalleryPhotoModel::query()->where("id",$pk)->get();
    }

    public static function create_gallery_photo($image_path="",$gallery_id=""){
        GalleryPhotoModel::create(["image_path"=>$image_path,"gallery_id"=>$gallery_id]);
    }

    public static function update_gallery($pk,$image_path="",$gallery_id=""){
        GalleryPhotoModel::query()->where("id",$pk)->update(["image_path"=>$image_path,"gallery_id"=>$gallery_id]);
    }

    public static function delete($pk)
    {
        GalleryPhotoModel::query()->where("id", $pk)->delete();
    }
}