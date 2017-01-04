<?php

namespace App\Models\Article;

use App\Models\Article\Traits\Attribute\ArticleAttribute;
use App\Models\Article\Traits\Relationship\ArticleRelationship;
use App\Models\Article\Traits\Scope\ArticleScope;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use ArticleAttribute,
        ArticleRelationship,
        ArticleScope,
        SoftDeletes;
    protected $table='articles';
    protected $fillable=[
        'title',
        'description',
        'content_original',
        'content',
        'slug',
        'view',
        'status',
        'category_id',
        'user_id',
        'published_at'
    ];

}
