<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('manage-users');
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
            'email'=>'required|email',
            'name'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'email'=>':attribute 格式错误'
        ];
    }

    public function attributes()
    {
        return [
            'email'=>'邮箱',
            'name'=>'用户名',
        ];
    }
}
