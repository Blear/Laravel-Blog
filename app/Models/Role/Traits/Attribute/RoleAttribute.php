<?php
namespace App\Models\Role\Traits\Attribute;
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 12:24
 */
trait RoleAttribute
{
    /**
     * 返回管理增删改URL修改器
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }

    /**
     * 修改url
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.role.edit',$this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="修改"></i></a> ';
    }

    /**
     * 删除url
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:void(0);" onclick="_delete($(this))" name="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i>
                <form action="'.route('admin.role.destroy',$this).'" method="POST" name="" style="display:none">
                    <input name="_method" value="delete" type="hidden">
                    <input name="_token" value="'.csrf_token().'" type="hidden">
                </form>
            </a> ';
    }
}