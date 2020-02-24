<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Career;

class CareerByidView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['career']=[];
        foreach (Career::all_careers() as $row){
            $info = [
                "pk"=>$row['id'],
                "job_title"=>$row['job_title'],
                "experience"=>$row['experience'],
                "position"=>$row['position'],
                "file_name"=>parent::static_url($row['file_name'])
            ];
            array_push($data['career'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}