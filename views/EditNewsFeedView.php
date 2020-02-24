<?php


namespace System\views;
use Config\Core\FileManager;
use Config\GlobalView;
use Controllers\NewsFeed;
use Models\NewsFeedModel;

class EditNewsFeedView extends GlobalView
{
    public function get($request, $response){
        $data = [
            "status"=>true,
        ];
        $data['newsfeeds'] = [];
        foreach (NewsFeed::get_one_news_feeds($request->id) as $row){
            $info = [
                "pk" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "news_type" => $row['news_type'],
                "current_date" => $row['current_date'],
                "news_link" => $row['link'],
                "end_date"=> $row['end_date'],
                "news_image"=>  parent::static_url($row['news_image']),
                "file_name"=> parent::static_url($row['file_name'])
            ];
            array_push($data['newsfeeds'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }


    public function post($request, $response){
        try{
            if (isset($_FILES['news_image'])){
                error_log("1",4);
                $news_images = FileManager::uploadSingleFile("newsfeed_images",'news_image');
            }else{
                if (isset($_POST['news_image_clear'])){
                    if ($_POST['news_image_clear'] == "on"){
                        $news_images = "";
                        error_log("2",4);
                    }else{
                        error_log("3",4);
                        $news_images = NewsFeed::get_one_news_feeds($_POST['news_id'])[0]['news_image'];
                    }
                }else{
                    error_log("4",4);
                    $news_images = NewsFeed::get_one_news_feeds($_POST['news_id'])[0]['news_image'];
                }
            }
            if (isset($_FILES['file_name'])){
                $file_name = FileManager::uploadSingleFile("file_name_images",'file_name');
            }else {
                if (isset($_POST['file_name_clear'])) {
                    if ($_POST['file_name_clear'] == "on") {
                        $file_name = "";
                    } else {
                        $file_name = NewsFeed::get_one_news_feeds($_POST['news_id'])[0]['file_name'];
                    }
                } else {
                    $file_name = NewsFeed::get_one_news_feeds($_POST['news_id'])[0]['file_name'];
                }
            }
            NewsFeed::update_news_feeds($_POST['news_id'],$_POST['title'],$_POST['description'],$_POST['link'],$_POST["news_type"],$_POST['current_date'],$_POST['end_date'],$file_name,$news_images);
            $data = [
                "status"=>true,
            ];
        }catch (\Exception $e){
            $data = [
                "status"=>false,
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}