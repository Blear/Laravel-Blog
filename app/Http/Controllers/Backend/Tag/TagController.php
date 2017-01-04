<?php

namespace App\Http\Controllers\Backend\Tag;

use App\Http\Requests\Backend\Tag\ManageTagRequest;
use App\Http\Requests\Backend\Tag\StoreTagRequest;
use App\Http\Requests\Backend\Tag\UpdateTagRequest;
use App\Models\Tag\Tag;
use App\Repositories\Backend\Tag\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    protected $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags=$tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageTagRequest $request)
    {
        //
        return view('backend.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageTagRequest $request)
    {
        //
        return view('backend.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        //
        $this->tags->create($request->only('name'));
        return redirect()->route('admin.tag.index')->withFlashSuccess('添加标签成功!');
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
    public function edit(Tag $tag,ManageTagRequest $request)
    {
        //
        return view('backend.tag.edit')
            ->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag,UpdateTagRequest $request)
    {
        //
        $this->tags->update($tag,$request->only('name'));
        return redirect()->route('admin.tag.index')->withFlashSuccess('修改标签成功!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag,ManageTagRequest $request)
    {
        //
        $this->tags->delete($tag);
        return redirect()->route('admin.tag.index')->withFlashSuccess('删除标签成功!');
    }
}
