<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Testimon;

class TestimonByIdView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['testmon'] = [];
        foreach (Testimon::get_one_testimon($request->id) as $row){
            $info = [
                "pk" => $row['id'],
                "image" => $row['image'],
                "company_description" => $row['company_description'],
                "customer_description" => $row['customer_description'],
                "customer_name" => $row['customer_name'],
            ];
            array_push($data['testmon'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}