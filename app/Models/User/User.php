<?php

namespace App\Models\User;

use App\Models\User\Traits\Relationship\UserRelationship;
use App\Models\User\Traits\Attribute\UserAttribute;
use App\Models\User\Traits\Scope\UserScope;
use App\Models\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UserAttribute,
        UserRelationship,
        Notifiable,
        SoftDeletes,
        UserScope,
        UserAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


}
