<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 14:16
 */

namespace App\Repositories\Frontend\Tag;


use App\Models\Tag\Tag;
use App\Repositories\Repository;


class TagRepository extends Repository
{
    const MODEL=Tag::class;
    protected $tag='tag';

    public function getTags()
    {
        return cache()->remember($this->tag.'all',60,function(){
            return $this->query()
                ->withCount('articles')
                ->get();
        });
    }

    public function getTagByName($name)
    {
        return cache()->remember($this->tag.'name'.$name,60,function() use($name){
            return $this->query()
                ->where('name',$name)
                ->firstOrFail();
        });
    }

    public function getArticlesByTag($tag,$page=6)
    {
        return cache()->remember('article'.'tag'.$tag->id.request()->get('page', 1),60,function() use($tag,$page){
            return $tag
                ->articles()
                ->Published(true)
                ->orderBy('published_at','desc')
                ->with('category','tags')
                ->paginate($page);
        });
    }


}