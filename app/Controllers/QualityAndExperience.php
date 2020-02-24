<?php


namespace Controllers;
use Models\QualityAndExperienceModel;

class QualityAndExperience
{
    public static function all_quality_experience(){
        return QualityAndExperienceModel::all();
    }

    public static function delete($pk){
        return QualityAndExperienceModel::query()->where("id",$pk)->delete();
    }

    public static function create_quality_and_experience($career_id="",$qualification=""){
        return QualityAndExperienceModel::create(["career_id"=>$career_id,"qualification"=>$qualification]);
    }

    public static function update_quality_and_experience($pk,$career_id="",$qualification=""){
        return QualityAndExperienceModel::query()->where("id",$pk)->update(["career_id"=>$career_id,"qualification"=>$qualification]);
    }

    public static function get_one_quality_and_experience($pk){
        return QualityAndExperienceModel::query()->where("id",$pk)->get();
    }
}