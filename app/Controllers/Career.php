<?php


namespace Controllers;
use Models\CareerModel;

class Career
{
  public static function all_careers(){
      return CareerModel::all();
  }

    public static function career_count(){
        return CareerModel::all()->count();
    }

    public static function get_one_career($pk){
        return CareerModel::query()->where("id",$pk)->get();
    }

  public static function delete_career($pk){
      return CareerModel::query()->where("id",$pk)->delete();
  }

  public static function create_career($job_title="",$position="",$experience="",$file_name=""){
      return CareerModel::create(["job_title"=>$job_title,"position"=>$position,"experience"=>$experience,"file_name"=>$file_name]);
  }

    public static function update_career($pk,$job_title="",$position="",$experience="",$file_name=""){
        return CareerModel::query()->where("id",$pk)->update(["job_title"=>$job_title,"position"=>$position,"experience"=>$experience,"file_name"=>$file_name]);
    }
}