<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $timestamp = false;
    protected $fillable = [
        'title', 'image', 'status', 'publisher_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'favorites';
    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
}
