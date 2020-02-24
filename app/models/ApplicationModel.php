<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    protected $table="Application";
    protected $guarded=[];


    public function career(){
        return $this->belongsTo(CareerModel::class,"career_id");
    }
}