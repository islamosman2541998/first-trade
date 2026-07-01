<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];
}