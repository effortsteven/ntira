<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\NewsFeed;

class DeleteNewsFeed extends GlobalView
{
    public function get($request,$response){
        try{
            $url = NewsFeed::get_one_news_feeds($request->id)[0]['news_image'];
            NewsFeed::delete($request->id);
            FileManager::deleteFile($url);
            $data = [
                "status"=>true,
                "message"=> "Successfully Removed"
            ];
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false,
                "message"=> "Failed to Remove"
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}