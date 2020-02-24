<?php


namespace Controllers;
use Models\InnerProductModel;

class InnerProduct
{
    public static function all_inner_product($product_id){
        return InnerProductModel::query()->where("product_id",$product_id)->get();
    }

    public static function all(){
        return InnerProductModel::all();
    }

    public static function get_inner_product($pk){
        return InnerProductModel::query()->where("id",$pk)->get();
    }

    public static function delete_inner_product($pk){
        return InnerProductModel::query()->where("id",$pk)->delete();
    }

    public static function create_inner_product($product_id="",$title="",$description="",$link="",$images=""){
        return InnerProductModel::create(["product_id"=>$product_id,"title"=>$title,"description"=>$description,"link"=>$link,"images"=>$images]);
    }

    public static function update_inner_product($inner_product_id,$title="",$description="",$link="",$images=""){
        return InnerProductModel::query()->where("id",$inner_product_id)->update(["title"=>$title,"description"=>$description,"link"=>$link,"images"=>$images]);
    }
}