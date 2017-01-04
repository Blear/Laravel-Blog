<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'name'=>'required|max:255',
            'password'=>'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'email'=>':attribute 格式错误',
            'password.min'=>'密码长度至少六位',
            'name.max'=>'用户名长度最长为255',
            'confirmed'=>'确认密码错误'
        ];
    }

    public function attributes()
    {
        return [
            'email'=>'邮箱',
            'name'=>'用户名',
            'password'=>'密码',
        ];
    }
}
