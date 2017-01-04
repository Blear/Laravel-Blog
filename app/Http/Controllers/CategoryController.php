<?php

namespace App\Http\Controllers;

use App\Repositories\Frontend\Article\ArticleRepository;
use App\Repositories\Frontend\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $categories;
    protected $articles;
    public function __construct(CategoryRepository $categories,ArticleRepository $articles)
    {
        $this->categories=$categories;
        $this->articles=$articles;
    }

    public function show($slug){
        $category=$this->categories->getCategoryBySlug($slug,config('page_size'));
        $articles=$this->articles->getArticlesByCategoryId($category->id);
        return view('themes.category')->with(compact('articles','category'));
    }
}
