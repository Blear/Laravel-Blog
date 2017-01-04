<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/27
 * Time: 10:19
 */

namespace App\Models\Page\Traits\Attribute;


trait PageAttribute
{
    public function getActionButtonsAttribute(){
        return $this->getEditButtonAttribute().
        $this->getDeleteButtonAttribute();
    }

    public function getEditButtonAttribute(){
        return '<a href="'.route('admin.page.edit',$this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="修改"></i></a> ';
    }

    public function getDeleteButtonAttribute(){
        return '<a href="javascript:void(0);" onclick="_delete($(this))" name="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i>
                <form action="'.route('admin.page.destroy',$this).'" method="POST" name="" style="display:none">
                    <input name="_method" value="delete" type="hidden">
                    <input name="_token" value="'.csrf_token().'" type="hidden">
                </form>
            </a> ';
    }
}