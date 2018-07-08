<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticlePost extends FormRequest
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
            'title'       => 'required|max:255',
            'excerpt'     => 'required',
            'content'     => 'required',
            'category_id' => 'required|integer|exists:categories,id',
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
            'title.required'       => '标题不能为空',
            'title.max'            => '标题长度不能超过 255 个字符',

            'excerpt.required'     => '文章摘要不能为空',

            'content.required'     => '文章内容不能为空',

            'category_id.required' => '文章分类不能为空',
            'category_id.integer'  => '文章分类 ID 必须是整型',
            'category_id.exists'   => '文章分类 ID 不存在',

            'tag.array'            => '标签必须为数组',
        ];
    }
}
