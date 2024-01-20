<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    public $timestamp = false;
    protected $fillable = [
        'fullname', 'username', 'email', 'password', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'publishers';
}
