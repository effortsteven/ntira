<?php


namespace Controllers;

use Models\TenderModel;
use Models\TestimonModel;

class Tender
{
    public static function all_tenders()
    {
        return TenderModel::all();
    }

    public static function tender_count()
    {
        return TenderModel::all()->count();
    }

    public static function all_tender_by_id($pk)
    {
        return TenderModel::query()->where("id", $pk)->get();
    }

    public static function create_tender($tender_number = "", $tender_category = "", $tender_description = "", $eligible_firm = "", $method_of_procurement = "", $deadline = "", $date_of_publish = "", $file_name = "", $document_price = "", $code_number = "")
    {
        return TenderModel::create(["tender_number" => $tender_number, "tender_category" => $tender_category, "tender_description" => $tender_description, "eligible_firm" => $eligible_firm, "method_of_procurement" => $method_of_procurement, "deadline" => $deadline, "date_of_publish" => $date_of_publish, "file_name" => $file_name, "document_price" => $document_price, "code_number" => $code_number]);
    }

    public static function update_tender($pk, $tender_number = "", $tender_category = "", $tender_description = "", $eligible_firm = "", $method_of_procurement = "", $deadline = "", $date_of_publish = "", $file_name = "", $document_price = "", $code_number = "")
    {
        TenderModel::query()->where("id", $pk)->update(["tender_number" => $tender_number, "tender_category" => $tender_category, "tender_description" => $tender_description, "eligible_firm" => $eligible_firm, "method_of_procurement" => $method_of_procurement, "deadline" => $deadline, "date_of_publish" => $date_of_publish, "file_name" => $file_name, "document_price" => $document_price, "code_number" => $code_number]);
    }

    public static function delete_tender($pk)
    {
        return TenderModel::query()->where("id", $pk)->delete();
    }
}