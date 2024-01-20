<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public $timestamp = false;
    protected $fillable = [
        'tentheloai', 'slug_theloai', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'theloai';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
    }
}
