<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/28
 * Time: 14:16
 */

namespace App\Repositories\Frontend\Article;


use App\Models\Article\Article;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;

class ArticleRepository extends Repository
{
    const MODEL=Article::class;
    protected $tag='article';

    public function getArticles($page=6)
    {
        return cache()->remember($this->tag.'all'.'page'.request()->get('page', 1),60,function() use($page){
            return $this->query()
                ->orderBy('published_at','desc')
                ->Published(true)
                ->with('category','tags')
                ->paginate($page);
        });
    }

    public function getHotArticles($count=6)
    {
        return cache()->remember($this->tag.'hot',60,function() use($count){
            return $this->query()
                ->orderBy('view','desc')
                ->Published(true)
                ->limit($count)
                ->get();
        });
    }

    public function getArticleBySlug($slug)
    {
        return cache()->remember($this->tag.'get'.$slug,60,function() use($slug){
            return $this->query()
                ->where('slug',$slug)
                ->Published(true)
                ->with('category','tags')
                ->firstOrFail();
        });
    }

    public function getArticlesByCategoryId($categoryId,$page=6)
    {
        return cache()->remember($this->tag.'categoryId'.$categoryId.'page'.request()->get('page', 1),60,function() use($categoryId,$page){
            return $this->query()
                ->where('category_id',$categoryId)
                ->orderBy('published_at','desc')
                ->Published(true)
                ->with('category','tags')
                ->paginate($page);
        });
    }

    public function getArticlesSearch($keyword,$page=6)
    {
        $keyword='%'.trim($keyword).'%';
        return $this->query()
            ->where('title','like',$keyword)
            ->orWhere('content', 'like', $keyword)
            ->with(['tags', 'category'])
            ->Published(true)
            ->orderBy('published_at','desc')
            ->paginate($page);
    }


}