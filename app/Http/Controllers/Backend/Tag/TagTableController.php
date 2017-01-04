<?php

namespace App\Http\Controllers\Backend\Tag;

use App\Http\Requests\Backend\Tag\ManageTagRequest;
use App\Repositories\Backend\Tag\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class TagTableController extends Controller
{
    //
    protected $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags=$tags;
    }

    public function __invoke(ManageTagRequest $request)
    {
        return Datatables::of($this->tags->getForDataTable())
            ->addColumn('actions',function($tag){
                return $tag->action_buttons;
            })
            ->make(true);
    }
}
