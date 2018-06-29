<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagPost extends FormRequest
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
        // Unique 规则忽略当前的 ID
        $id = $this->route('tag');

        return [
            'name' => 'required|max:255|unique:tags,name,' . $id
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
            'name.required' => '标签不能为空',
            'name.max'      => '标签长度不能超过 255 个字符',
            'name.unique'   => '标签已存在',
        ];
    }
}
