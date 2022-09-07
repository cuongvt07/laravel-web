<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required'
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã trùng',
            'price.required' => 'Giá tiền không được để trống',
            'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',        'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',
            'name.min' => 'Tên sản phẩm không được được nhỏ hơn 10   kí tự',
            'category_id.required' => 'Danh mục không được để trống',
            'contents.required' => 'Nội dung không được để trống',
            // 'contents.min' => 'Nội dung không được dưới 3 kí tự',

        ];
    }
}
