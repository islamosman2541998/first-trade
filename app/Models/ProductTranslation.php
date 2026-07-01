<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'short_description',
        'description',
    ];
}