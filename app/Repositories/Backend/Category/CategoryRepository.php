<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/23
 * Time: 15:24
 */

namespace App\Repositories\Backend\Category;


use App\Exceptions\GeneralException;
use App\Models\Category\Category;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Repository
{
    const MODEL=Category::class;

    /**
     * 简单的树形排序
     * @param Collection $collection
     * @param int $parentId
     * @param int $level
     * @param string $html
     * @return Collection
     */
    protected function tree(Collection $collection, $parentId = 0, $level = 0, $html = '-')
    {
        $data = new \Illuminate\Database\Eloquent\Collection();
        foreach ($collection as $k => $v) {
            if ($v->parent_id == $parentId) {
                $prefix='';
                if ($level != 0) {
                    $prefix = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level).'|';
                }
                $prefix .= str_repeat($html, $level);
                $v->name=$prefix.$v->name;
                $data->add($v);
                $temp=$this->tree($collection, $v->id, $level + 1);
                foreach($temp as $t){
                    $data->add($t);
                }
            }
        }
        return $data;
    }

    public function getForDataTable($order_by='sort',$sort='asc')
    {
        return $this->tree($this->query()->orderBy($order_by,$sort)->get());
    }

    public function create(array $input)
    {
        if($this->query()->where('name',$input['name'])->first()){
            throw new GeneralException('该分类名已存在!');
        }
        if($this->query()->where('slug',$input['slug'])->first()){
            throw new GeneralException('该slug已存在!');
        }
        $category=self::MODEL;
        $category=new $category;
        $category->name=$input['name'];
        $category->slug=$input['slug'];
        $category->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        $category->parent_id=isset($input['parent_id']) && strlen($input['parent_id']) > 0 && is_numeric($input['parent_id']) ? (int) $input['parent_id'] : 0;
        if(parent::save($category)){
            return true;
        }
        throw new GeneralException('分类添加失败!');
    }

    public function update(Model $category,array $input){
        $category->name=$input['name'];
        $category->slug=$input['slug'];
        $category->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        $category->parent_id=isset($input['parent_id']) && strlen($input['parent_id']) > 0 && is_numeric($input['parent_id']) ? (int) $input['parent_id'] : 0;
        if(parent::save($category)){
            return true;
        }
        throw new GeneralException('分类修改失败!');
    }

    public function delete(Model $category)
    {
        //该分类下是否有文章判断
        if($category->articles()->count()>0){
            throw new GeneralException('该分类下面有文章，无法删除!');
        }
        if(parent::delete($category)){
            return true;
        }
        throw new GeneralException('分类删除失败!');
    }

    /**
     * 获取树形分类下拉框数据
     * @return array
     */
    public function getCategoriesTree(){
        $categoriesTree=[
//            0=>'顶级分类',
        ];
        $categories=$this->tree(self::getAll());
        foreach($categories as $key => $value){
            $categoriesTree[$value->id]=$value->html.$value->name;
        }
        return $categoriesTree;
    }
}