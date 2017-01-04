<?php

namespace App\Http\Requests\Backend\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'name.max'=>'角色名称长度不得大于255个字符',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'角色名'
        ];
    }
}
