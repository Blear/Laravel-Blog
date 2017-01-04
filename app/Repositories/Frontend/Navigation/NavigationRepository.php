<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 14:16
 */

namespace App\Repositories\Frontend\Navigation;


use App\Models\Navigation\Navigation;
use App\Repositories\Repository;


class NavigationRepository extends Repository
{
    const MODEL=Navigation::class;
    protected $tag='navigation';

    public function getNavigations()
    {
        return cache()->remember($this->tag.'all',60,function(){
            return $this->query()
                ->orderBy('sort','esc')
                ->select([
                    'name',
                    'href',
                    'target',
                    'sort'
                ])
                ->get();
        });
    }
}