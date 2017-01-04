<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'password'=>'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'password.min'=>'密码长度至少六位',
            'confirmed'=>'确认密码错误'
        ];
    }

}
