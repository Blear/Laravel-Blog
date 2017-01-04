<?php

namespace App\Http\Controllers\Backend\Article;

use App\Http\Requests\Backend\Article\ManageArticleRequest;
use App\Repositories\Backend\Article\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ArticleTableController extends Controller
{
    //
    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles=$articles;
    }

    public function __invoke(ManageArticleRequest $request)
    {
        return Datatables::of($this->articles->getForDataTable($request->get('status'),$request->get('trashed')))
            ->addColumn('user',function($article){
                return $article->user->name;
            })
            ->addColumn('category',function($article){
                return $article->category->name;
            })
            ->addColumn('tags',function($article){
                return $article->tags->count() ?
                    implode("、", $article->tags->pluck('name')->toArray()) :
                    '无';
            })
            ->addcolumn('actions',function($article){
                return $article->action_buttons;
            })
            ->make(true);
    }
}
