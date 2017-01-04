<?php

namespace App\Http\Requests\Backend\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-articles');
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
            'category_id'=>'required',
            'description'=>'required',
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
            'title'=>'文章标题',
            'category_id'=>'文章分类',
            'description'=>'文章简介',
            'content_original'=>'文章内容',
        ];
    }
}
