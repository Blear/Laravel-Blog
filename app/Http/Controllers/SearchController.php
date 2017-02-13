<?php

namespace App\Http\Controllers;

use App\Article;
use App\Repositories\Frontend\Article\ArticleRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    protected $articles;
    public function __construct(ArticleRepository $articles)
    {
        $this->articles=$articles;
    }

    public function search(Request $request){

        $keyword=$request->get("keyword");
        $articles=$this->articles->getArticlesSearch($keyword,env('PAGE_SIZE',6));
        $articles->appends(['keyword'=>$keyword])->render();
        return view('themes.search')->with(compact('articles','keyword'));
    }
}
