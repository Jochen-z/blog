<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticlePost extends FormRequest
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
            'title'       => 'max:255',
            'category_id' => 'integer|exists:categories,id',
            'tag'         => 'array'
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
            'title.max'            => '标题长度不能超过 255 个字符',

            'category_id.integer'  => '文章分类 ID 必须是整型',
            'category_id.exists'   => '文章分类 ID 不存在',

            'tag.array'            => '标签必须为数组',
        ];
    }
}
