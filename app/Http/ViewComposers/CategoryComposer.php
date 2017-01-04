<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;
use App\Category;
use App\Repositories\Frontend\Category\CategoryRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryComposer{
    protected $categories;
    public function __construct(CategoryRepository $categories)
    {
        $this->categories=$categories;
    }

    public function compose(View $view){
        $categories=$this->categories->getCategories()->reject(function ($category) {
            return $category->articles_count == 0;
        });
        $view->with('categories',$categories);
    }

}