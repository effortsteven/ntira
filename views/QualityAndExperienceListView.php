<?php


namespace System\views;
use Config\GlobalView;
use Controllers\QualityAndExperience;

class QualityAndExperienceListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['qualification_and_experience_list']=[];
        foreach (QualityAndExperience::all_quality_experience() as $row){
            $info = [
                "pk"=>$row['id'],
                "career_id"=>$row['career_id'],
                "qualification"=>$row['qualification'],
                "is_active"=>$row['is_active']
            ];
            array_push($data['qualification_and_experience_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }

    public function post($request,$response){
        try{
            QualityAndExperience::create_quality_and_experience($_POST['career_id'],$_POST['qualification']);
            $data = [
                "status"=>true
            ];
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
            $data = [
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}