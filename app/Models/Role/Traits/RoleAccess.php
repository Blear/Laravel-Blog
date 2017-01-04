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

    /**
     * 附加多对多模型关联
     * @param $permission
     */
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

    /**
     * 取消多对多模型关联
     * @param $permission
     */
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

    /**
     * 批量关联多对多模型
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->attachPermission($permission);
        }
    }

    /**
     * 批量取消多对多关联
     * @param $permissions
     */
    public function detachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->detachPermission($permission);
        }
    }
}