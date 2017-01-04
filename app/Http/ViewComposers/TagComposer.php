<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;
use App\Repositories\Frontend\Tag\TagRepository;
use App\Tag;
use Illuminate\View\View;

class TagComposer{
    protected $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags=$tags;
    }

    public function compose(View $view){
        $tags=$this->tags->getTags()->reject(function ($category) {
            return $category->articles_count == 0;
        });
        $view->with('tags',$tags);
    }

}