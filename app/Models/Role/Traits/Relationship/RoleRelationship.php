<?php
namespace App\Models\Role\Traits\Relationship;
use App\Models\Permission\Permission;
use App\Models\User\User;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 12:24
 */
trait RoleRelationship
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}