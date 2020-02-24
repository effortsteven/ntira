<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Career;

class CareerListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['career_list']=[];
        foreach (Career::all_careers() as $row){
            $info = [
                "pk"=>$row['id'],
                "job_title"=>$row['job_title'],
                "experience"=>$row['experience'],
                "file_name"=>$row['file_name']
            ];
            array_push($data['career_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}