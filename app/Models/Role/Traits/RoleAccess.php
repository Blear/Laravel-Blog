<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/23
 * Time: 9:36
 */

namespace App\Models\Role\Traits;


trait RoleAccess
{


    public function attachPermission($permission)
    {
        if(is_object($permission)){
            $permission=$permission->getKey();
        }
        if(is_array($permission)){
            $permission=$permission['id'];
        }
        $this->permissions()->attach($permission);
    }


    public function detachPermission($permission)
    {
        if(is_object($permission)){
            $permission=$permission->getKey();
        }
        if(is_array($permission)){
            $permission=$permission['id'];
        }
        $this->permissions()->detach($permission);
    }


    public function attachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->attachPermission($permission);
        }
    }


    public function detachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->detachPermission($permission);
        }
    }
}