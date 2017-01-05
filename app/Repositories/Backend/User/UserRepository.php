<?php

namespace App\Repositories\Backend\User;

use App\Exceptions\GeneralException;
use App\Models\User\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class UserRepository extends Repository
{
    const MODEL=User::class;


    public function getForDataTable($status = 1, $trashed = false)
    {
        $dataTableQuery=$this->query()
            ->with('roles')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at'
        ]);
        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery->active($status);
    }


    public function create(array $input)
    {
        $data = $input['data'];
        $roles = $input['roles'];
        $user = $this->createUserStub($data);
        DB::transaction(function() use($user,$data,$roles){
            if(parent::save($user)){
                $this->checkUserRolesCount($roles);
                $user->attachRoles($roles['assignees_roles']);
                return true;
            }
            throw new GeneralException('添加用户失败!');
        });
    }


    public function update(Model $user, array $input)
    {
        $data=$input['data'];
        $roles=$input['roles'];
        $this->checkUserByEmail($data,$user);
        DB::transaction(function() use($user,$data,$roles){
            if(parent::update($user,$data)){
                $user->status = isset($data['status']) ? 1 : 0;
                parent::save($user);

                $this->checkUserRolesCount($roles);
                $this->flushRoles($roles, $user);
                return true;
            }
            throw new GeneralException('更新用户信息失败!');

        });
    }


    public function delete(Model $user){
        if(access()->id()==$user->id){
            throw new GeneralException('您无法删除您自己的账号!');
        }
        if(parent::delete($user)){
            return true;
        }
        throw new GeneralException('删除用户失败!');
    }

    public function forceDelete(Model $user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException('请先正常删除后,再进行彻底删除此用户!');
        }
        DB::transaction(function() use ($user) {
            if (parent::forceDelete($user)) {
                return true;
            }

            throw new GeneralException('删除用户失败!');
        });
    }


    public function restore(Model $user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException('改用户处于正常状态,无需恢复!');
        }
        if(parent::restore($user)){
            return true;
        }
        throw new GeneralException('用户恢复失败!');
    }



    public function updatePassword(Model $user, $input)
    {
        $user->password = bcrypt($input['password']);

        if (parent::save($user)) {
            return true;
        }

        throw new GeneralException('密码修改失败!');
    }

    public function mark(Model $user,$status)
    {
        if (access()->id() == $user->id && $status == 0) {
            throw new GeneralException('您不能禁用您自己的账户!');
        }
        $user->status=$status;

        if(parent::save($user)){
            return true;
        }
        throw new GeneralException('用户状态修改失败!');
    }



    protected function checkUserByEmail($input,$user)
    {
        if($user->email!=$input['email']){
            if($this->query()->where('email',$input['email'])->first()){
                throw new GeneralException('用户邮箱已被使用!');
            }
        }
    }


    protected function checkUserRolesCount($roles)
    {
        if (count($roles['assignees_roles']) == 0) {
            throw new GeneralException('请至少选择一个用户角色!');
        }
    }


    protected function flushRoles($roles, $user)
    {
        //删除原来的角色，添加新的角色
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }


    protected function createUserStub($input){
        $user					 = self::MODEL;
        $user                    = new $user;
        $user->name              = $input['name'];
        $user->email             = $input['email'];
        $user->password          = bcrypt($input['password']);
        $user->status            = isset($input['status']) ? 1 : 0;
        return $user;
    }

}