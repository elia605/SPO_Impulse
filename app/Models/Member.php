<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'FIO',
        'birthday',
        'role',
        'phone',
        'email',
        'group',
        'notify',
        'status',
    ];

    public function file()
    {
        return $this->morphOne(File::class, 'file');
    }
}
