<?php
namespace App\Services\Access;
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/20
 * Time: 13:13
 */
class Access
{
    /**
     * 获取已经登录的用户
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * 判断是否是登录
     * @return bool
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * 获取用户id
     * @return int|null
     */
    public function id()
    {
        return auth()->id();
    }



    /**
     * 判断当前用户是否有属于指定角色
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if($user=$this->user()){
            return $user->hasRole($role);
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
        if($user=$this->user()){
            return $user->hasRoles($roles, $needsAll);
        }
        return false;
    }

    /**
     * 判断是否用户是否具有指定权限
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if($user=$this->user()){
            return $user->hasPermission($permission);
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
        if($user=$this->user()){
            return $user->hasPermissions($permissions,$needsAll);
        }
        return false;
    }
}