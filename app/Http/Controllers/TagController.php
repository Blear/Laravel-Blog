<?php

namespace App\Http\Controllers;

use App\Repositories\Frontend\Article\ArticleRepository;
use App\Repositories\Frontend\Tag\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    protected $tags;
    protected $articles;

    public function __construct(TagRepository $tags,ArticleRepository $articles)
    {
        $this->tags=$tags;
        $this->articles=$articles;
    }

    public function show($name){
        $tag=$this->tags->getTagByName($name);
        $articles=$this->tags->getArticlesByTag($tag,env('PAGE_SIZE',6));
        return view('themes.tag')->with(compact('articles','tag'));
    }


}
