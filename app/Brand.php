<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'thumbUrl',
        'category_id',
        'user_id'
    ];
}
