<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title', 'description', 'color', 'price', 'date', 'file'];
}
