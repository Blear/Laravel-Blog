<?php
namespace App\Models\Permission\Traits\Relationship;
use App\Models\Role\Role;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 12:30
 */
trait PermissionRelationship
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}