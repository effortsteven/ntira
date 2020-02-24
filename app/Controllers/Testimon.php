<?php


namespace Controllers;
use Models\TestimonModel;

class Testimon
{
  public static function create_testimon($image="",$company_description="",$customer_description="",$customer_name=""){
      return TestimonModel::create(["image"=>$image,"company_description"=>$company_description,"customer_description"=>$customer_description,"customer_name"=>$customer_name]);
  }

  public static function update_testimon($pk, $image="",$company_description="",$customer_description="",$customer_name=""){
      return TestimonModel::query()->where("id",$pk)->update(["image"=>$image,"company_description"=>$company_description,"customer_description"=>$customer_description,"customer_name"=>$customer_name]);
  }

  public static function get_all_testimon(){
      return TestimonModel::all();
  }

  public static function get_one_testimon($pk){
      return TestimonModel::query()->where("id",$pk)->get();
  }

  public static function delete_testimon($pk){
      return TestimonModel::query()->where("id",$pk)->delete();
  }
}