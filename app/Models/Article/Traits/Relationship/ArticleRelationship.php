<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 14:44
 */

namespace App\Models\Article\Traits\Relationship;


use App\Models\Category\Category;
use App\Models\Tag\Tag;
use App\Models\User\User;

trait ArticleRelationship
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}