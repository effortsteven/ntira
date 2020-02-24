<?php


namespace Controllers;
use Models\BranchModel;

class Branch
{
    public static function all_branch(){
        return BranchModel::all();
    }

    public static function delete_branch(){
        return BranchModel::query()->delete();
    }

    public static function branch_count(){
        return BranchModel::all()->count();
    }

    public static function get_one_branch($pk){
        return BranchModel::query()->where("id",$pk)->get();
    }

    public static function get_one_branch_by_name($name){
        return BranchModel::query()->where("name",$name)->get();
    }

    public static function create_branch($name="",$code="",$street="",$district="",$latitude="",$longitude="",$phone="",$po_box=""){
        return BranchModel::create(["name"=>$name,"code"=>$code,"street"=>$street,"district"=>$district,"latitude"=>$latitude,"longitude"=>$longitude,"phone"=>$phone,"po_box"=>$po_box]);
    }

    public static function update_branch($pk,$name="",$code="",$street="",$district="",$latitude="",$longitude="",$phone="",$po_box=""){
        return BranchModel::query()->where("id",$pk)->update(["name"=>$name,"code"=>$code,"street"=>$street,"district"=>$district,"latitude"=>$latitude,"longitude"=>$longitude,"phone"=>$phone,"po_box"=>$po_box]);
    }
}