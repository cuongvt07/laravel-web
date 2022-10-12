<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255|min:2',
            'description' => 'required'
            //
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'Tên slider không được để trống',
            'name.unique' => 'Tên slider đã trùng',
            'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',    
                'name.max' => 'Tên sản phẩm không được được quá 255 kí tự',
            'name.min' => 'Tên sản phẩm không được được nhỏ hơn 10   kí tự',
            'description.required' => 'Nội dung không được để trống',
            // 'contents.min' => 'Nội dung không được dưới 3 kí tự',

        ];
    }
}
