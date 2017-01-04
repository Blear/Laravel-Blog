<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 14:13
 */

namespace App\Repositories\Backend\Article;


use App\Exceptions\GeneralException;
use App\Models\Article\Article;
use App\Models\Tag\Tag;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Parsedown;

class ArticleRepository extends Repository
{
    const MODEL=Article::class;
    protected $markdownParser;

    public function __construct()
    {
        $this->markdownParser=new Parsedown();
    }

    public function getForDataTable($status = 1, $trashed = false)
    {
        $dataTableQuery = $this->query()
            ->with('user','category','tags')
            ->select([
            'articles.id',
            'articles.title',
            'articles.status',
            'articles.user_id',
            'articles.category_id',
            'articles.published_at',
            'articles.updated_at',
            'articles.deleted_at'
        ]);
        if($trashed == 'true'){
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery->Published($status);
    }

    public function create(array $input)
    {
        $data=$input['data'];
        $tags=$input['tags'];
        if($this->query()->where('slug',$data['slug'])->first()){
            throw new GeneralException('数据库中已存在此slug');
        }
        $article=$this->createArticleStub($data);
        DB::transaction(function() use($article,$tags){
            if(parent::save($article)){
                $tagIds=[];
                if(!empty($tags['tags'])){
                    foreach($tags['tags'] as $name){
                        $tag=Tag::firstOrCreate(['name'=>$name]);
                        array_push($tagIds,$tag->id);
                    }
                }
                $article->tags()->sync($tagIds);
                return true;
            }
            throw new GeneralException('添加文章失败!');
        });
    }

    public function update(Model $article,array $input)
    {
        $data=$input['data'];
        $tags=$input['tags'];
        $data['content']=$this->markdownParser->setBreaksEnabled(true)->text($data['content_original']);
        DB::transaction(function() use($article,$data,$tags){
            if(parent::update($article,$data)){
                $tagIds=[];
                if(!empty($tags['tags'])){
                    foreach($tags['tags'] as $name){
                        $tag=Tag::firstOrCreate(['name'=>$name]);
                        array_push($tagIds,$tag->id);
                    }
                }
                $article->tags()->sync($tagIds);
                return true;
            }
            throw new GeneralException('修改文章失败!');
        });
    }

    public function delete(Model $article)
    {
        if(parent::delete($article)){
            return true;
        }
        throw new GeneralException('删除文章失败!');
    }

    public function mark(Model $article,$status)
    {
        $article->status=$status;

        if(parent::save($article)){
            return true;
        }
        throw new GeneralException('文章状态修改失败!');
    }

    protected function createArticleStub($input)
    {
        $article=self::MODEL;
        $article=new $article;
        $article->title=$input['title'];
        $article->slug=$input['slug'];
        $article->category_id=isset($input['category_id'])&&strlen($input['category_id'])>0&&is_numeric($input['category_id'])?(int)$input['category_id']:0;
        $article->description=$input['description'];
        $article->content_original=$input['content_original'];
        $article->content=$this->markdownParser->setBreaksEnabled(true)->text($input['content_original']);
        $article->status=$input['status']==1?1:0;
        $article->user_id=access()->id();
        if($input['status']==1){
            $article->published_at=Carbon::now();
        }
        return $article;
    }
}