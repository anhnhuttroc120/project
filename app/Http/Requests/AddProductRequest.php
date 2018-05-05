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
                'sale_off'=>'numeric|required',
                'description'=>'required' ,
                'picture.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048'  //
        ];
    }
}
