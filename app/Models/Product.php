<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','category','brand','image','price','rating','description'];

    function getImageAttribute($name){
        return '/data/products/images/'.$name;
    }
}
