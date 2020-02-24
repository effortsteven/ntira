<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\Gallery;
use Controllers\GalleryPhoto;

class PhotoView extends GlobalView
{
    public function get($request,$response){
        $gallery_photos = GalleryPhoto::all_gallery_photo_with_details();
        $galleries = Gallery::all_gallery();
        return View::render("photos.html.twig",["gallery_photos"=>$gallery_photos,"galleries"=>$galleries]);
    }
}