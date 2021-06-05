<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
    ];

    public function file() : MorphOne
    {
        return $this->morphOne(File::class, 'file');
    }
}
