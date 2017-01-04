<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/24
 * Time: 15:12
 */

namespace App\Repositories\Backend\Tag;


use App\Exceptions\GeneralException;
use App\Models\Tag\Tag;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends Repository
{
    const MODEL=Tag::class;

    public function getForDataTable()
    {
        return $this->query()->select([
            'tags.id',
            'tags.name',
            'tags.created_at'
        ]);
    }

    public function create(array $input)
    {
        if($this->query()->where('name',$input['name'])->first()){
            throw new GeneralException('该标签名已存在!');
        }
        $tag=self::MODEL;
        $tag=new $tag;
        $tag->name=$input['name'];
        if(parent::save($tag)){
            return true;
        }
        throw new GeneralException('添加标签失败!');
    }

    public function update(Model $tag,array $input)
    {
        $tag->name=$input['name'];
        if(parent::save($tag)){
            return true;
        }
        throw new GeneralException('修改标签失败!');
    }

    public function delete(Model $tag)
    {
        if(parent::delete($tag)){
            return true;
        }
        throw new GeneralException('删除标签失败!');
    }

}