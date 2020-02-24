<?php


namespace System\views;
use Config\GlobalView;
use Controllers\EducationInfo;

class EducationInfoListView extends GlobalView
{
    public static function get($request,$response){
        $data = [];
        foreach (EducationInfo::all_by_application($request->id) as $row){
            $info = [
                "pk"=>$row['id'],
                "education_type"=>$row['education_type'],
                "name"=>$row['name'],
                "finish_year"=>$row['finish_year'],
                "exam_passed"=>$row['exam_passed'],
                "pass_by"=>$row['pass_by']
            ];
            array_push($data,$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}