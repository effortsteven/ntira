<?php


namespace Controllers;
use Models\WebProductModel;

class WebProduct
{
    public static function all_web_products(){
        return WebProductModel::all();
    }

    public static function get_web_product($pk){
        return WebProductModel::query()->where("id",$pk)->get();
    }

    public static function get_life_web_product($product_type){
        return WebProductModel::query()->where("product_type",$product_type)->get();
    }

    public static function create_web_product($title="",$description="",$link="",$image="",$product_type="",$has_child=""){
        WebProductModel::create(["title"=>$title,"description"=>$description,"link"=>$link,"images"=>$image,"product_type"=>$product_type,"has_child"=>$has_child]);
    }

    public static function update_news_web_product($pk,$title="",$description="",$link="",$image="",$product_type="",$has_child=""){
        WebProductModel::query()->where("id",$pk)->update(["title"=>$title,"description"=>$description,"link"=>$link,"images"=>$image,"product_type"=>$product_type,"has_child"=>$has_child]);
    }

    public static function delete($pk){
        WebProductModel::query()->where("id",$pk)->delete();
    }
}