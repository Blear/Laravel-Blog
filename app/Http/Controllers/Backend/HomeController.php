<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\ManageSettingRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Article\ArticleRepository;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Repositories\Backend\Setting\SettingRepository;
use App\Repositories\Backend\Tag\TagRepository;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
    protected $articles;
    protected $users;
    protected $categories;
    protected $tags;
    protected $settings;
    public function __construct(ArticleRepository $articles,UserRepository $users,CategoryRepository $categories,TagRepository $tags,SettingRepository $settings)
    {
        $this->articles=$articles;
        $this->users=$users;
        $this->categories=$categories;
        $this->tags=$tags;
        $this->settings=$settings;
    }

    public function index(){
        return view('backend.home')
            ->withArticleCount($this->articles->getCount())
            ->withUserCount($this->users->getCount())
            ->withCategoryCount($this->categories->getCount())
            ->withTagCount($this->tags->getCount());
    }

    public function setting(ManageSettingRequest $request){
        if($request->method()=="POST"){
            $this->settings->saveSetting($request->except('_token'));
            return redirect()->route('admin.setting')->withFlashSuccess('网站配置保存成功!');
        }else{
            return view('backend.setting');
        }
    }

    public function clear(Request $request)
    {
        cache()->flush();
        return redirect()->route('admin.home')->withFlashSuccess('清除站点缓存成功!');
    }
}
