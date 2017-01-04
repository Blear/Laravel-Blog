<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/25
 * Time: 13:08
 */

namespace App\Models\Article\Traits\Attribute;


trait ArticleAttribute
{
    /**
     * 返回管理增删改URL修改器
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return $this->getRestoreButtonAttribute() .
            $this->getDeletePermanentlyButtonAttribute();
        }

        return
            $this->getEditButtonAttribute() .
            $this->getStatusButtonAttribute() .
            $this->getDeleteButtonAttribute();
    }



    /**
     * 编辑url
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.article.edit',$this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }


    /**
     * 暂停或者启用连接
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<a href="'.route('admin.article.mark',[$this,1]).'" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="发布"></i></a> ';
            // No break

            case 1:
                return '<a href="'.route('admin.article.mark',[$this,0]).'" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="移入草稿箱"></i></a> ';
            // No break

            default:
                return '';
            // No break
        }

    }

    /**
     * 删除url
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:void(0);" onclick="_delete($(this))" name="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i>
            <form action="'.route('admin.article.destroy',$this).'" method="POST" name="" style="display:none">
                <input name="_method" value="delete" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
            </form>
        </a> ';

    }

    /**
     * 软删除恢复
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="' . route('admin.article.restore', $this) . '" name="restore_user" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="恢复"></i></a> ';
    }

    /**
     * 彻底删除
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="' . route('admin.article.delete-permanently', $this) . '" name="delete_user_perm" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="彻底删除"></i></a> ';
    }
}