<?php


namespace System\views;
use Config\GlobalView;
use Controllers\Tender;

class TenderListView extends GlobalView
{
    public function get($request,$response){
        $data = [
            "status"=>true
        ];
        $data['tender_list'] = [];
        foreach (Tender::all_tenders() as $row){
            $info = [
                "pk"=>$row['id'],
                "tender_number"=>$row['tender_number'],
                "tender_category"=>$row['tender_category'],
                "tender_description"=>$row['tender_description'],
                "eligible_firm"=>$row['eligible_firm'],
                "method_of_procurement"=>$row['method_of_procurement'],
                "code_number"=>$row['code_number'],
                "document_price"=>$row['document_price'],
                "deadline"=>$row['deadline'],
                "date_of_publish"=>$row['date_of_publish'],
                "file_name"=>parent::static_url($row['file_name'])
            ];
            array_push($data['tender_list'],$info);
        }
        $send = $request->param("format","json");
        $response->$send([$data]);
    }
}