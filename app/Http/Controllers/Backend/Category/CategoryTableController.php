<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use App\Repositories\Backend\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class CategoryTableController extends Controller
{
    //
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories=$categories;
    }

    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->categories->getForDataTable())
            ->addColumn('actions',function($category){
                return $category->action_buttons;
            })
            ->make(true);
    }
}
