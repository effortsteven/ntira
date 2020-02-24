<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Testimon;

class TestimonListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=> true
        ];
        $data['testmons_list'] = [];
        foreach (Testimon::get_all_testimon() as $row){
            $info = [
                "pk" => $row['id'],
                "image" => $row['image'],
                "company_description" => $row['company_description'],
                "customer_description" => $row['customer_description'],
                "customer_name" => $row['customer_name'],
            ];
            array_push($data['testmons_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}