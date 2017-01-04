<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category\Category;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories=$categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageCategoryRequest $request)
    {
        //
//        dd(tree($this->categories->getAll()));
        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageCategoryRequest $request)
    {
        //
        return view('backend.category.create')
            ->withCategories($this->categories->getCategoriesTree())
            ->withCategoryCount($this->categories->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category,StoreCategoryRequest $request)
    {
        //
        $this->categories->create($request->all());
        return redirect()->route('admin.category.index')->withFlashSuccess('添加分类成功!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,ManageCategoryRequest $request)
    {
        //
        return view('backend.category.edit')
            ->withCategories($this->categories->getCategoriesTree())
            ->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category,UpdateCategoryRequest $request)
    {
        //
        $this->categories->update($category,$request->all());
        return redirect()->route('admin.category.index')->withFlashSuccess('分类修改成功!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,ManageCategoryRequest $request)
    {
        //
        $this->categories->delete($category);
        return redirect()->route('admin.category.index')->withFlashSuccess('分类删除成功!');
    }
}
