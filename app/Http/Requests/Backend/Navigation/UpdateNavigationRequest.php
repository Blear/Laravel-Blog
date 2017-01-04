<?php

namespace App\Http\Requests\Backend\Navigation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNavigationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-navigations');
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
            'name.max'=>'导航名称长度不得大于255个字符',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'导航名称'
        ];
    }
}
