<?php


namespace Controllers;
use Models\NewsFeedModel;

class NewsFeed
{
    public static function all_news_feeds(){
        return NewsFeedModel::all();
    }

    public static function get_one_news_feeds($pk){
        return NewsFeedModel::query()->where("id",$pk)->get();
    }

    public static function delete($pk){
        NewsFeedModel::query()->where("id",$pk)->delete();
    }

    public static function create_news_feeds($title="",$description="",$news_link="",$news_type="",$start_date="",$end_date="",$news_file="",$news_image=""){
        NewsFeedModel::create(["title"=>$title,"description"=>$description,"link"=>$news_link,"news_type"=>$news_type,"current_date"=>$start_date,"end_date"=>$end_date,"file_name"=>$news_file,"news_image"=>$news_image]);
    }


    public static function update_news_feeds($pk,$title="",$description="",$news_link="",$news_type="",$start_date="",$end_date="",$news_file="",$news_image=""){
        NewsFeedModel::query()->where("id",$pk)->update(["title"=>$title,"description"=>$description,"link"=>$news_link,"news_type"=>$news_type,"current_date"=>$start_date,"end_date"=>$end_date,"file_name"=>$news_file,"news_image"=>$news_image]);
    }
}