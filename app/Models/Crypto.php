<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ['cryptocurrency', 'price'];

}
