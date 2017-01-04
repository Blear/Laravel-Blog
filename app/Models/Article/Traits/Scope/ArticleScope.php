<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 14:25
 */

namespace App\Models\Article\Traits\Scope;


trait ArticleScope
{
    public function scopePublished($query,$status){
        return $query->where('status',$status);
    }
}