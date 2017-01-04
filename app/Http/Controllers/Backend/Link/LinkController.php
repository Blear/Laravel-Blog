<?php

namespace App\Http\Controllers\Backend\Link;

use App\Http\Requests\Backend\Link\ManageLinkRequest;
use App\Http\Requests\Backend\Link\StoreLinkRequest;
use App\Http\Requests\Backend\Link\UpdateLinkRequest;
use App\Models\Link\Link;
use App\Repositories\Backend\Link\LinkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    protected $links;
    public function __construct(LinkRepository $links)
    {
        $this->links=$links;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageLinkRequest $request)
    {
        //
        return view('backend.link.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageLinkRequest $request)
    {
        //
        return view('backend.link.create')
            ->withLinkCount($this->links->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLinkRequest $request)
    {
        //
        $this->links->create($request->all());
        return redirect()->route('admin.link.index')->withFlashSuccess('友情链接添加成功!');
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
    public function edit(Link $link,ManageLinkRequest $request)
    {
        //
        return view('backend.link.edit')
            ->withLink($link);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Link $link,UpdateLinkRequest $request)
    {
        //
        $this->links->update($link,$request->all());
        return redirect()->route('admin.link.index')->withFlashSuccess('修改友情链接成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link,ManageLinkRequest $request)
    {
        //
        $this->links->delete($link);
        return redirect()->route('admin.link.index')->withFlashSuccess('删除友情链接成功!');
    }
}
