<?php


namespace System\views;
use Config\GlobalView;
use Config\View;

class BranchView extends GlobalView
{
    public function get($request,$response){
        try{
            $client = curl_init("http://192.168.43.86:8001/api/v1/branches/");
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
            error_log(json_decode($response),4);
        }catch (\Exception $e){
            error_log($e->getMessage(),4);
        }
        return View::render("branch.html.twig");
    }
}