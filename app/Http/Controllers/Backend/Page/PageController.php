<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Requests\Backend\Page\ManagePageRequest;
use App\Http\Requests\Backend\Page\StorePageRequest;
use App\Http\Requests\Backend\Page\UpdatePageRequest;
use App\Models\Page\Page;
use App\Repositories\Backend\Page\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    protected $pages;

    public function __construct(PageRepository $pages)
    {
        $this->pages=$pages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManagePageRequest $request)
    {
        //
        return view('backend.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManagePageRequest $request)
    {
        //
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        //
        $this->pages->create($request->all());
        return redirect()->route('admin.page.index')->withFlashSuccess('页面创建成功!');
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
    public function edit(Page $page,ManagePageRequest $request)
    {
        //
        return view('backend.page.edit')
            ->withPage($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page,UpdatePageRequest $request)
    {
        //
        $this->pages->update($page,$request->all());

        return redirect()->route('admin.page.index')->withFlashSuccess('页面修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
