<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\Branch;

class ContactView extends GlobalView
{
    public function get($request,$response){
        $branch_list = [];
        try{
            $client = curl_init("http://motor.nictanzania.co.tz/api/v1/branches/");
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
            $branches = json_decode($response,true);
            if ($branches){
                Branch::delete_branch();
                foreach ($branches as $branch){
                    Branch::create_branch($branch['name'],"",$branch['street'],$branch['district'],$branch['latitude'],$branch['longitude'],$branch['phone'],$branch['po_box']);
                }
            }
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
        }
        foreach (Branch::all_branch() as $branch){
            $info = [
                "id"=>$branch['id'],
                "name"=>$branch['name'],
                "phone"=>$branch['phone'],
                "po_box"=>$branch['po_box'],
                "street"=>$branch['street'],
                "district"=>$branch['district']
            ];
            array_push($branch_list,$info);
        }
        return View::render("contact.html.twig",["branch_list"=>$branch_list]);
    }
}