<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public $timestamp = false;
    protected $fillable = [
        'tentruyen','tacgia','tomtat','danhmuc_id','theloai_id','banner_id','views_truyen',
        'hinhanh','slug_truyen','created_at','updated_at','truyen_noibat','topview','trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function danhmuctruyen(){
        return $this->belongsTo('App\Models\DanhmucTruyen','danhmuc_id','id');
    }
    public function banner(){
        return $this->belongsTo('App\Models\Banner','banner_id','id');
    }
    public function chapter(){
        return $this->hasMany('App\Models\Chapter','truyen_id','id');
    }
    public function theloai(){
        return $this->belongsTo('App\Models\Theloai','theloai_id','id');
    }
    public function thuocnhieutheloaitruyen(){
        return $this->belongsToMany(Theloai::class,'thuocloai','truyen_id','theloai_id');
    }
}
