<?php


namespace System\views;

use Config\GlobalView;
use Controllers\CustomerEmail;
use Controllers\NewsFeed;
use Config\Core\FileManager;

class NewsFeedView extends GlobalView
{
    public function get($request, $response)
    {
        $data = [
            "status" => true,
        ];
        $data['newsfeeds'] = [];
        foreach (NewsFeed::all_news_feeds() as $row) {
            $info = [
                "pk" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "news_type" => $row['news_type'],
                "current_date" => $row['current_date'],
                "news_link" => $row['link'],
                "end_date" => $row['end_date'],
                "news_image" => parent::static_url($row['news_image']),
                "file_name" => parent::static_url($row['file_name'])
            ];
            array_push($data['newsfeeds'], $info);
        }
        $send = $request->param("format", "json");
        $response->$send([$data]);
    }

    public function post($request, $response)
    {
        try {

            if (isset($_FILES['news_image'])) {
                $news_images = FileManager::uploadSingleFile("news_images", "news_image");
            } else {
                $news_images = "";
            }
            if (isset($_FILES['file_name'])) {
                $file_name = FileManager::uploadSingleFile("news_files", "file_name");
            } else {
                $file_name = "";
            }
            NewsFeed::create_news_feeds($_POST['title'], $_POST['description'], $_POST['link'], $_POST["news_type"], $_POST['current_date'], $_POST['end_date'], $file_name, $news_images);
            $data = [
                "status" => true,
            ];
            $data['emails'] = [];
            foreach (CustomerEmail::all() as $row) {
                $info = [
                    "email" => $row['email']
                ];
                array_push($data['emails'], $info);
            }
        } catch (\Exception $e) {
            error_log($e->getMessage(), 4);
            $data = [
                "status" => false,
            ];
        }
        $send = $request->param("format", "json");
        $response->$send([$data]);
    }

}