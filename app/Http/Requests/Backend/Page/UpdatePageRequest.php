<?php

namespace App\Http\Requests\Backend\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-pages');
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
            'title'=>'required|max:255',
            'slug'=>'required|max:255',
            'content_original'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'title.max'=>'文章标题长度不得大于255个字符',
            'slug.max'=>'slug长度不得大于255个字符',
        ];
    }

    public function attributes()
    {
        return [
            'title'=>'页面标题',
            'content_original'=>'页面内容',
        ];
    }
}
