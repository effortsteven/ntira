<?php


namespace Controllers;
use Models\JobObjectiveModel;

class JobObjective
{
    public static function all_objectives($career_id=""){
        return JobObjectiveModel::query()->where("career_id",$career_id)->get();
    }
    public static function all(){
        return JobObjectiveModel::all();
    }

    public static function get_one_objectives($career_id=""){
        return JobObjectiveModel::query()->where("id",$career_id)->get();
    }

    public static function create_job_objective($career_id="",$description){
        return JobObjectiveModel::create(["career_id"=>$career_id,"description"=>$description]);
    }

    public static function update_job_objective($pk,$description=""){
        return JobObjectiveModel::query()->where("id",$pk)->update(["description"=>$description]);
    }

    public static function delete($pk){
        JobObjectiveModel::query()->where("id",$pk)->delete();
    }
}