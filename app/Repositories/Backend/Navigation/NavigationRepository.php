<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 8:55
 */

namespace App\Repositories\Backend\Navigation;


use App\Exceptions\GeneralException;
use App\Models\Navigation\Navigation;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class NavigationRepository extends Repository
{
    const MODEL=Navigation::class;

    public function getForDataTable($order_by='sort',$sort='asc'){
        return $this->query()->orderBy($order_by,$sort)->select([
            'navigations.id',
            'navigations.name',
            'navigations.href',
            'navigations.sort'
        ]);
    }

    public function create(array $input)
    {
        $navigation=self::MODEL;
        $navigation=new $navigation;
        $navigation->name=$input['name'];
        $navigation->href=$input['type']==1?config('app.url').'/'.$input['page']:$input['href'];
        $navigation->target=$input['target']=='_target'?'_target':'_self';
        $navigation->sort=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
        if(parent::save($navigation)){
            return true;
        }
        throw new GeneralException('添加导航失败!');
    }

    public function update(Model $navigation,array $input)
    {
        $input['href']=$input['type']==1?config('app.url').'/'.$input['page']:$input['href'];
        $input['target']=$input['target']=='_target'?'_target':'_self';
        $input['sort']=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
        if(parent::update($navigation,$input)){
            return true;
        }
        throw new GeneralException('修改导航失败!');
    }

    public function delete(Model $navigation){
        if(parent::delete($navigation)){
            return true;
        }
        throw new GeneralException('删除导航失败!');
    }
}