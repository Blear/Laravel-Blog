<?php
namespace App\Models\User\Traits\Relationship;
use App\Models\Article\Article;
use App\Models\Role\Role;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 8:52
 */
trait UserRelationship
{
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}