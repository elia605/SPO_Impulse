<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'vkontakte_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name' => 'string',
        'id' => 'integer',
    ];

    public $primaryKey = 'id';

    public function roles() : HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function member() : HasOne
    {
        return $this->hasOne(Member::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'file');
    }

    public function isAdmin()
    {
        if ($this->roles->where('role', 'admin')->count() !== 0)
        {
            return true;
        }
        return false;
    }

    public function isOrg()
    {
        if ($this->roles->where('role', 'org')->count() !== 0)
        {
            return true;
        }
        return false;
    }

    public function isMember() : bool
    {
        if ($this->roles->where('role', 'member')->count() !== 0)
        {
            return true;
        }
        return false;
    }

    public function isGuest() : bool
    {
        if ($this->roles->where('role', 'guest')->count() !== 0)
        {
            return true;
        }
        return false;
    }

    public function memberActions($key)
    {
        $user = $this->hasMany(MemberAction::class, 'user_id');
        return $user->where('user_id', $this->id)->where('action_id', $key)->count();
    }
}
