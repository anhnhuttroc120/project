<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class EditProductRequest extends FormRequest
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
        $id = ($request->route('id'));
        return ['name'=>'required|unique:products,name,'.$id.',id','category_id'=>'required|numeric','price'=>'numeric|required','sale_off'=>'numeric|required','description'=>'required'
            //
        ];
    }
}
