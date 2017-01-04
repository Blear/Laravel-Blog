<?php
namespace App\Models\User\Traits;
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/20
 * Time: 15:15
 */
trait UserAccess
{

    /**
     * 循环添加角色
     * @param $roles
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * 循环删除角色
     * @param $roles
     */
    public function detachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * 添加角色
     * @param $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    /**
     * 删除角色
     * @param $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }


    /**
     * 判断用户是否具有指定角色
     * @param $nameOrId
     * @return bool
     */
    public function hasRole($nameOrId)
    {
        foreach($this->roles as $role){
            if($role->all){
                return true;
            }

            if(is_numeric($nameOrId)){
                if($role->id==$nameOrId){
                    return true;
                }
            }

            if($role->name==$nameOrId){
                return true;
            }
        }
        return false;
    }

    /**
     * 判断用户是否具有多个角色，可以指定匹配全部或满足其中一个
     * @param $roles
     * @param bool $needsAll
     * @return bool
     */
    public function hasRoles($roles,$needsAll=false)
    {
        if(!is_array($roles)){
            $roles=array($roles);
        }

        if($needsAll){
            $hasRoles=0;
            $numRoles=count($roles);
            foreach ($roles as $role) {
                if($this->hasRole($role)){
                    $hasRoles++;
                }
            }
            return $hasRoles==$numRoles;
        }

        foreach ($roles as $role) {
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }


    /**
     * 判断当前用户是否指定权限
     * @param $nameOrId
     * @return bool
     */
    public function hasPermission($nameOrId)
    {
        foreach($this->roles as  $role){
            if($role->all){
                return true;
            }

            foreach($role->permissions as $perm){
                if(is_numeric($nameOrId)){
                    if($perm->id==$nameOrId){
                        return true;
                    }
                }

                if($perm->name==$nameOrId){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 判断用户是否有多个权限，可以指定匹配全部或满足其中一个
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        if (! is_array($permissions)) {
            $permissions = array($permissions);
        }

        if ($needsAll) {
            $hasPermissions = 0;
            $numPermissions = count($permissions);

            foreach ($permissions as $perm) {
                if ($this->hasPermission($perm)) {
                    $hasPermissions++;
                }
            }

            return $numPermissions == $hasPermissions;
        }

        foreach ($permissions as $perm) {
            if ($this->hasPermission($perm)) {
                return true;
            }
        }

        return false;
    }


}