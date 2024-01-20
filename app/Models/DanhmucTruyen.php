<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucTruyen extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public $timestamp = false;
    protected $fillable = [
        'tendanhmuc', 'slug_danhmuc', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'danhmuc';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
    }
}
