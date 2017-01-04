<?php

namespace App\Http\Controllers\Backend\Navigation;

use App\Http\Requests\Backend\Navigation\ManageNavigationRequest;
use App\Http\Requests\Backend\Navigation\StoreNavigationRequest;
use App\Models\Navigation\Navigation;
use App\Repositories\Backend\Navigation\NavigationRepository;
use App\Repositories\Backend\Page\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    protected $navigations;
    protected $pages;
    public function __construct(NavigationRepository $navigations,PageRepository $pages)
    {
        $this->navigations=$navigations;
        $this->pages=$pages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageNavigationRequest $request)
    {
        //
        return view('backend.navigation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageNavigationRequest $request)
    {
        //
        return view('backend.navigation.create')
            ->withPages($this->pages->getForNavigation())
            ->withNavigationCount($this->navigations->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNavigationRequest $request)
    {
        //
        $this->navigations->create($request->all());
        return redirect()->route('admin.navigation.index')->withFlashSuccess('导航添加成功!');
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
    public function edit(Navigation $navigation,ManageNavigationRequest $request)
    {
        //
        return view('backend.navigation.edit')
            ->withNavigation($navigation)
            ->withPages($this->pages->getForNavigation());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Navigation $navigation,ManageNavigationRequest $request)
    {
        //
        $this->navigations->update($navigation,$request->all());
        return redirect()->route('admin.navigation.index')->withFlashSuccess('修改导航成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navigation $navigation,ManageNavigationRequest $request)
    {
        //
        $this->navigations->delete($navigation);
        return redirect()->route('admin.navigation.index')->withFlashSuccess('删除导航成功!');
    }
}
