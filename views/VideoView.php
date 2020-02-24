<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\Channel;
use Controllers\Gallery;

class VideoView extends GlobalView
{
    public function get($request,$response){
        $video_list = [];
        $channels = Channel::all_channel();
        foreach (Gallery::all_gallery() as $row){
            $video = $row['video_path'];
            if ($video != ""){
                $info = [
                    "title"=>$row['title'],
                    "description"=>$row['description'],
                    "video_path"=>$video
                ];
                array_push($video_list,$info);
            }
        }
        return View::render("videos.html.twig", ["channels"=>$channels,"video_list"=>$video_list]);
    }
}