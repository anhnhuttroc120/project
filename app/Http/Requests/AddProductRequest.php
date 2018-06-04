<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return ['name'=>'required|unique:products,name',
                'category_id'=>'required|numeric',
                'price'=>'numeric|required',
                'sale_off'=>'numeric',
                'description'=>'required' ,
                'picture.*'=>'image|mimes:jpeg,png,jpg,svg|max:204833',
                'picture'=>'required'
                  //
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên không được trống',
            'name.unique' =>'Tên sản phẩm đã tồn tài',
            'category_id.numeric'=>'Vui lòng chọn giá trị khác mặc định',
            'price.numeric'=>'Gía sản phẩm phài là số',
            'price.required'=>'Giá sản phẩm không đc rỗng',
            'sale_off.numeric'=>'Giảm giá phải là số',
            'picture.required'=>'Hình không đc rỗng',
            'description.required' =>'Nội dung không đc  rỗng' , 
            'picture.*.mimes'=>'Hình ảnh không đúng định dạng',
            'picture.*image'=>'File này không phải là hình ảnh',
            'picture.*.max' =>'kích cở ảnh quá lớn không phù hợp'

        ];
    }
}
