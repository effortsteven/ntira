<?php


namespace Controllers;
use Models\ApplicationModel;

class Application
{
    public static function all_application(){
        return ApplicationModel::all();
    }

    public static function all_application_career($pk){
        return ApplicationModel::query()->where("career_id",$pk)->get();
    }

    public static function personal_application($pk,$full_name){
        return ApplicationModel::query()->where("career_id",$pk)->where("full_name",$full_name)->get();
    }

    public static function delete($pk){
        ApplicationModel::query()->where("id",$pk)->delete();
    }

    public static function create_application($career_id="",$full_name="",$dob="",$postal_address="",$place_of_birth="",$nationality="",$marital_status="",$phone="",$others=""){
        ApplicationModel::create(["career_id"=>$career_id,"full_name"=>$full_name,"dob"=>$dob,"postal_address"=>$postal_address,"place_birth"=>$place_of_birth,"nationality"=>$nationality,"marital_status"=>$marital_status,"phone"=>$phone,"others"=>$others]);
    }
}