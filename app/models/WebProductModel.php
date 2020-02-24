<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class WebProductModel extends Model
{
    protected $table = 'WebProduct';
    protected $guarded = [];


    public function inner_product(){
        return $this->hasMany(InnerProductModel::class,"product_id");
    }
}