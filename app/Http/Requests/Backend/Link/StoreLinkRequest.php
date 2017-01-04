<?php

namespace App\Http\Requests\Backend\Link;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-links');
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
            'href'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'name.max'=>'链接名称长度不得大于255个字符',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'连接名称',
            'href'=>'连接地址'
        ];
    }
}
