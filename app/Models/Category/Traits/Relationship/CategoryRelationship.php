<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 14:49
 */

namespace App\Models\Category\Traits\Relationship;


use App\Models\Article\Article;

trait CategoryRelationship
{
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}