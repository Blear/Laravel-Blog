<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/29
 * Time: 8:55
 */

namespace App\Repositories\Backend\Link;


use App\Models\Link\Link;
use App\Exceptions\GeneralException;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class LinkRepository extends Repository
{
    const MODEL=Link::class;

    public function getForDataTable($order_by='sort',$sort='asc'){
        return $this->query()->orderBy($order_by,$sort)->select([
            'links.id',
            'links.name',
            'links.href',
            'links.sort'
        ]);
    }

    public function create(array $input)
    {
        $link=self::MODEL;
        $link=new $link;
        $link->name=$input['name'];
        $link->href=$input['href'];
        $link->sort=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
        if(parent::save($link)){
            return true;
        }
        throw new GeneralException('添加友情连接失败!');
    }

    public function update(Model $link,array $input)
    {
        $input['sort']=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
        if(parent::update($link,$input)){
            return true;
        }
        throw new GeneralException('修改友情连接失败!');
    }

    public function delete(Model $link){
        if(parent::delete($link)){
            return true;
        }
        throw new GeneralException('删除友情连接失败!');
    }
}