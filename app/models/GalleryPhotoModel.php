<?php


namespace Models;
use Controllers\Gallery;
use Controllers\GalleryPhoto;
use Illuminate\Database\Eloquent\Model;

class GalleryPhotoModel extends Model
{
    protected $table="GalleryPhoto";
    protected $guarded=[];

    public function gallery(){
        return $this->belongsTo(GalleryModel::class,"gallery_id");
    }
}