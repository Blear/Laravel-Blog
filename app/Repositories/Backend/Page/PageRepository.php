<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/27
 * Time: 10:04
 */

namespace App\Repositories\Backend\Page;

use Illuminate\Database\Eloquent\Model;
use Parsedown;
use App\Exceptions\GeneralException;
use App\Models\Page\Page;
use App\Repositories\Repository;

class PageRepository extends Repository
{
    const MODEL=Page::class;
    protected $markdownParser;

    public function __construct()
    {
        $this->markdownParser=new Parsedown();
    }

    public function getForDataTable()
    {
        return $this->query()->select([
            'pages.id',
            'pages.title',
            'pages.slug',
            'pages.created_at',
            'pages.updated_at',
        ]);
    }

    public function getForNavigation()
    {
        return $this->query()->select([
            'pages.title',
            'pages.slug'
        ])->get();
    }

    public function create(array $input)
    {
        if($this->query()->where('slug',$input['slug'])->first()){
            throw new GeneralException('数据库中已存在此slug');
        }
        $page=$this->createPageStub($input);
        if(parent::save($page)){
            return true;
        }
        throw new GeneralException('页面创建失败!');
    }

    public function update(Model $page,array $input)
    {
        $input['content']=$this->markdownParser->setBreaksEnabled(true)->text($input['content_original']);
        if(parent::update($page,$input)){
            return true;
        }
        throw new GeneralException('修改页面失败!');
    }

    protected function createPageStub($input)
    {
        $page=self::MODEL;
        $page=new $page;
        $page->title=$input['title'];
        $page->slug=$input['slug'];
        $page->content_original=$input['content_original'];
        $page->content=$this->markdownParser->setBreaksEnabled(true)->text($input['content_original']);
        return $page;
    }
}