<?php


namespace System\views;
use Config\GlobalView;
use Controllers\QualityAndExperience;

class EditQualityAndExperienceView extends GlobalView
{
    public static function post($request,$response)
    {
        try{
            QualityAndExperience::update_quality_and_experience($request->id,$_POST['qualification_and_experience_id'],$_POST['qualification']);
            $data=[
                "status"=>true
            ];
        }catch (\Exception $e){
            $data=[
                "status"=>false
            ];
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}