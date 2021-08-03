<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'description',
        'thumbUrl'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
