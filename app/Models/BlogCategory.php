<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
