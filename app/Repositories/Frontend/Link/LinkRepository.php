<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 14:16
 */

namespace App\Repositories\Frontend\Link;


use App\Models\Link\Link;
use App\Repositories\Repository;


class LinkRepository extends Repository
{
    const MODEL=Link::class;
    protected $tag='link';

    public function getLinks()
    {
        return cache()->remember($this->tag.'all',60,function(){
            return $this->query()
                ->orderBy('sort','esc')
                ->select([
                    'name',
                    'href',
                    'sort'
                ])
                ->get();
        });
    }
}