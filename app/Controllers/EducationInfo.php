<?php


namespace Controllers;
use Models\EducationInfoModel;

class EducationInfo
{
    public static function all(){
        return EducationInfoModel::all();
    }

    public static function all_by_application($pk){
        return EducationInfoModel::query()->where("application_id",$pk)->get();
    }


    public static function create_education_info($application_id="",$education_type="",$name="",$finish_year="",$exam_passed,$pass_by=""){
        EducationInfoModel::create(["application_id"=>$application_id,"education_type"=>$education_type,"name"=>$name,"finish_year"=>$finish_year,"exam_passed"=>$exam_passed,"pass_by"=>$pass_by]);
    }
}