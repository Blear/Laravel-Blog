<?php

namespace App\Http\Controllers;

use App\Repositories\Frontend\Article\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articles;
    public function __construct(ArticleRepository $articles)
    {
        $this->articles=$articles;
    }

    public function index()
    {
        return view('themes.index')->withArticles($this->articles->getArticles(config('page_size')));
    }

    public function show($slug){
        $article=$this->articles->getArticleBySlug($slug);
        $article->increment('view');
        return view('themes.article')->with(compact('article'));
    }
}
