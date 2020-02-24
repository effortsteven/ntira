<?php


namespace Controllers;
use Models\CustomerEmailModel;

class CustomerEmail
{
    public static function all(){
        return CustomerEmailModel::all();
    }

    public static function get_one_email($email=""){
        return CustomerEmailModel::query()->where("email",$email)->get();
    }

    public static function create_email($email){
        return CustomerEmailModel::create(["email"=>$email]);
    }

    public static function delete($pk){
        CustomerEmailModel::query()->where("id",$pk)->delete();
    }
}