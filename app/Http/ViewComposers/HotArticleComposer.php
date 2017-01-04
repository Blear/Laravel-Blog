<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;

use App\Repositories\Frontend\Article\ArticleRepository;
use Illuminate\View\View;

class HotArticleComposer{
    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles=$articles;
    }

    public function compose(View $view){
        $hotArticles=$this->articles->getHotArticles(6);
        $view->with('hotarticles',$hotArticles);
    }

}