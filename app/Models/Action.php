<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'members_max',
        'action_starts_at',
        'action_ends_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'action_starts_at' => 'datetime',
        'action_ends_at' => 'datetime'
    ];

    public function memberActions()
    {
        return $this->hasMany(MemberAction::class);
    }

    public function file() : MorphOne
    {
        return $this->morphOne(File::class, 'file');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
