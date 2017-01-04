<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-categories');
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
            'slug'=>'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'name.max'=>'分类名称长度不得大于255个字符',
            'slug.max'=>'slug长度不得大于255个字符',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'分类名'
        ];
    }
}
