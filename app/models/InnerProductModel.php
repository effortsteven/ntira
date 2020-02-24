<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class InnerProductModel extends Model
{
    protected $table="InnerProduct";
    protected $guarded =[];


    public function web_product(){
        return $this->belongsTo(WebProductModel::class);
    }
}