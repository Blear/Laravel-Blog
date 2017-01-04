<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 14:16
 */

namespace App\Repositories\Frontend\Category;


use App\Models\Category\Category;
use App\Repositories\Repository;


class CategoryRepository extends Repository
{
    const MODEL=Category::class;
    protected $tag='category';

    public function getCategories()
    {
        return cache()->remember($this->tag.'all',60,function(){
            return $this->query()
                ->orderBy('sort','esc')
                ->withCount('articles')
                ->get();
        });
    }

    public function getCategoryBySlug($slug)
    {
        return cache()->remember($this->tag.'get'.$slug,60,function() use($slug){
            return $this->query()
                ->where('slug',$slug)
                ->orderBy('sort','esc')
                ->firstOrFail();
        });
    }


}