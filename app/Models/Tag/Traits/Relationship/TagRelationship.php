<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 14:55
 */

namespace App\Models\Tag\Traits\Relationship;


use App\Models\Article\Article;

trait TagRelationship
{
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}