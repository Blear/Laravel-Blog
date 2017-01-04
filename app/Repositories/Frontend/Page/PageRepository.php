<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/29
 * Time: 13:26
 */

namespace App\Repositories\Frontend\Page;


use App\Models\Page\Page;
use App\Repositories\Repository;

class PageRepository extends Repository
{
    const MODEL=Page::class;
    protected $tag='page';
    public function getPageBySlug($slug)
    {
        return cache()->remember($this->tag.'get'.$slug,60,function() use($slug){
            return $this->query()
                ->where('slug',$slug)
                ->firstOrFail();
        });
    }
}