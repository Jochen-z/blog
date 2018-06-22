<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'bail|required|email|exists:users',
            'password' => 'required|min:6|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.email'    => '邮箱地址不合法',
            'email.exists'   => '邮箱不存在',

            'password.required' => '密码不能为空',
            'password.min'      => '密码不能小于6位',
            'password.max'      => '密码不能大于255位',
        ];
    }
}
