<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class QualityAndExperienceModel extends Model
{
    protected $table="QualityAnExperience";
    protected $guarded=[];

    public function career(){
        return $this->belongsTo(CareerModel::class,"career_id");
    }
}