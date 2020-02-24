<?php


namespace Controllers;
use Models\ChannelModel;

class Channel
{
    public static function all_channel(){
        return ChannelModel::all();
    }

    public static function delete($pk){
        ChannelModel::query()->where("id",$pk)->delete();
    }

    public static function create_channel($name){
        ChannelModel::create(["name"=>$name]);
    }
}