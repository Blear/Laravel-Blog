<?php

namespace App\Http\Controllers\Backend\Article;

use App\Http\Requests\Backend\Article\ManageArticleRequest;
use App\Models\Article\Article;
use App\Repositories\Backend\Article\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleStatusController extends Controller
{
    //
    protected $articles;
    public function __construct(ArticleRepository $articles)
    {
        $this->articles=$articles;
    }

    public function getdraft(ManageArticleRequest $request)
    {
        return view('backend.article.draft');
    }

    public function mark(Article $article,$status,ManageArticleRequest $request)
    {
        $this->articles->mark($article,$status);
        return redirect()->route($status == 1 ? "admin.article.index" : "admin.article.draft")->withFlashSuccess('文章状态修改成功!');
    }

    public function getDeleted(ManageArticleRequest $request)
    {
        return view('backend.article.deleted');
    }

    public function restore(Article $deletedArticle, ManageArticleRequest $request)
    {
        $this->articles->restore($deletedArticle);
        return redirect()->route('admin.article.deleted')->withFlashSuccess('文章恢复成功!');
    }

    public function delete(Article $deletedArticle,ManageArticleRequest $request)
    {
        $this->articles->forceDelete($deletedArticle);
        return redirect()->route('admin.article.deleted')->withFlashSuccess('文章删除成功!');
    }
}
