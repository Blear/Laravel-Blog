<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 13:14
 */

namespace App\Repositories\Backend\Role;


use App\Exceptions\GeneralException;
use App\Models\Role\Role;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleRepository extends Repository
{
    const MODEL=Role::class;


    public function getForDataTable($order_by='sort',$sort='asc'){
        return $this->query()
            ->with('users','permissions')
            ->orderBy($order_by,$sort)
            ->select([
                'roles.id',
                'roles.name',
                'roles.all',
                'roles.sort'
            ]);
    }


    public function getAll($order_by='sort',$sort='asc')
    {
        return $this->query()
            ->orderBy($order_by,$sort)
            ->get();
    }


    public function create(array $input)
    {
        if($this->query()->where('name',$input['name'])->first()){
            throw new GeneralException('该角色名称已存在!');
        }
        $all=$input['associated-permissions']=='all'?true:false;
        if(!isset($input['permissions']))
            $input['permissions']=[];

//        if(!$all){
//            if(count($input['permissions'])==0){
//                throw new GeneralException('请至少添加一个权限!');
//            }
//        }
        DB::transaction(function() use($input,$all){
            $role=self::MODEL;
            $role=new $role;
            $role->name=$input['name'];
            $role->sort=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
            $role->all=$all;
            if(parent::save($role)){
                if(!$all){
                    $permissions=[];
                    if(is_array($input['permissions'])&&count($input['permissions'])){
                        foreach($input['permissions'] as $perm){
                            if(is_numeric($perm)){
                                array_push($permissions,$perm);
                            }
                        }
                    }
                    $role->attachPermissions($permissions);
                }
                return true;
            }
            throw new GeneralException('角色添加失败!');

        });

    }


    public function update(Model $role,array $input)
    {
        if($role->id==1){
            $all=true;
        }else{
            $all=$input['associated-permissions']=='all'?true:false;
        }
        if (! isset($input['permissions']))
            $input['permissions'] = [];
        if(!$all){
            if(count($input['permissions'])==0){
                throw new GeneralException('请至少添加一个权限!');
            }
        }
        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        $role->all = $all;
        DB::transaction(function() use($role,$all,$input){
            if(parent::save($role)){
                if($all){
                    $role->permissions()->sync([]);
                }else{
                    $role->permissions()->sync([]);
                    $permissions=[];
                    if(is_array($input['permissions'])&&count($input['permissions'])){
                        foreach($input['permissions'] as $perm){
                            if(is_numeric($perm)){
                                array_push($permissions,$perm);
                            }
                        }
                    }
                    $role->attachPermissions($permissions);
                }
                return true;
            }
            throw new GeneralException('角色更新失败!');
        });
    }

    public function delete(Model $role)
    {
        if($role->id==1){
            throw new GeneralException('系统角色无法删除!');
        }
        if($role->users()->count()>0){
            throw new GeneralException('该角色下面有用户，无法删除!');
        }
        DB::transaction(function() use($role){
            $role->permissions()->sync([]);
            if(parent::delete($role)){
                return true;
            }
            throw new GeneralException('角色删除失败!');
        });
    }

}