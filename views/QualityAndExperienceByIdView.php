<?php


namespace System\views;
use Config\GlobalView;
use Controllers\QualityAndExperience;

class QualityAndExperienceByIdView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['qualification_and_experience']=[];
        foreach (QualityAndExperience::get_one_quality_and_experience($request->id) as $row){
            $info = [
                "pk"=>$row['id'],
                "career_id"=>$row['career_id'],
                "qualification"=>$row['qualification'],
                "is_active"=>$row['is_active']
            ];
            array_push($data['qualification_and_experience'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}