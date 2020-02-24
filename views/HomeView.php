<?php
namespace System\views;

use Config\Core\FileManager;
use Config\GlobalView;
use Config\View;
use Config\Form;
use Controllers\Gallery;
use Controllers\GalleryPhoto;
use Controllers\NewsFeed;



class HomeView extends GlobalView
{
    public function get($request,$response){
        $news_feeds = NewsFeed::all_news_feeds();
        $galleries = Gallery::all_gallery_current();
        $galleries_photos = GalleryPhoto::all_gallery_photo_with_details();
        return View::render("index.html.twig",["news_feeds"=>$news_feeds,"galleries"=>$galleries,"galleries_photos"=>$galleries_photos]);
    }
}
