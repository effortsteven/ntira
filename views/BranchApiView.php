<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Branch;

class BranchApiView extends GlobalView
{
    public function get($request,$response){
        try{
            $client = curl_init("http://192.168.43.86:8001/api/v1/branches/");
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
            error_log(json_decode($response),4);
        }catch (\Exception $e){

        }
    }
}