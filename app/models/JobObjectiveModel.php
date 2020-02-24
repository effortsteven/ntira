<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class JobObjectiveModel extends Model
{
    protected $table="JobObjective";
    protected $guarded=[];

    public function career(){
        return $this->belongsTo(CareerModel::class,"career_id");
    }
}