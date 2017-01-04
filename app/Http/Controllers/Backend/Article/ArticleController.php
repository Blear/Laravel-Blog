<?php

namespace App\Http\Controllers\Backend\Article;

use App\Http\Requests\Backend\Article\ManageArticleRequest;
use App\Http\Requests\Backend\Article\StoreArticleRequest;
use App\Http\Requests\Backend\Article\UpdateArticleRequest;
use App\Models\Article\Article;
use App\Repositories\Backend\Article\ArticleRepository;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Repositories\Backend\Tag\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articles;
    protected $categories;
    protected $tags;

    public function __construct(ArticleRepository $articles,CategoryRepository $categories,TagRepository $tags)
    {
        $this->articles=$articles;
        $this->categories=$categories;
        $this->tags=$tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageArticleRequest $request)
    {
        //
        return view('backend.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageArticleRequest $request)
    {
        //
        return view('backend.article.create')
            ->withCategories($this->categories->getCategoriesTree())
            ->withTags($this->tags->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        //
        $this->articles->create(['data'=>$request->except('tag'),'tags'=>$request->only('tags')]);
        return redirect()->route('admin.article.index')->withFlashSuccess('文章添加成功!');
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
    public function edit(Article $article,ManageArticleRequest $request)
    {
        //
        return view('backend.article.edit')
            ->withCategories($this->categories->getCategoriesTree())
            ->withTags($this->tags->getAll())
            ->withArticle($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article,UpdateArticleRequest $request)
    {
        //
        $this->articles->update($article,['data'=>$request->except('tag'),'tags'=>$request->only('tags')]);
        return redirect()->route('admin.article.index')->withFlashSuccess('修改文章成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article,ManageArticleRequest $request)
    {
        //
        $this->articles->delete($article);
        return redirect()->route('admin.article.deleted')->withFlashSuccess('文章已移到回收站!');

    }

    public function uploadImage(Request $request)
    {
        if ($file = $request->file('file')) {
            $folderName ='uploads/images/' . date("Ymd", time()) .'/'. Auth::user()->id;
            $allowed_extensions = ["png", "jpg", "gif", 'jpeg'];
            $fileType=$file->getClientOriginalExtension();
            if (in_array($fileType, $allowed_extensions)) {
                $destinationPath = public_path() . '/' . $folderName;
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $fileName  = date("YmdHis", time()).rand(111,999) . '.' . $extension;
                $file->move($destinationPath, $fileName);
                return ['filename' => get_cdn_domain().'/'.$folderName .'/'. $fileName];
            }else{
                return ['error'=>'You can only upload image with extensions: ' . implode($allowed_extensions, ',')];
            }
        }
        return ['error'=>'Upload Fail!'];

    }
}
