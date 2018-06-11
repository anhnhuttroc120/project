<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class EditUserRequest extends FormRequest
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
        $id = $request->route('id');
        return [
           'username'=>'unique:users,username,'.$id.',id',
           'fullname'=>'required',
           'email'=>'required|unique:users,email,'.$id.',id',
           'phone'=>'required|min:10|max:11',
           'address'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tên',
            'username.unique'   => 'Tên tài khoản đã tồn tại',
            'email.required'    => 'Vui lòng nhập email',
            'email.unique'      => 'Email đã tồn tại',
            'phone.required'    => 'Vui lòng nhập điện thoại',
            'phone.min'         => 'Không phải định dạng số điện thoại',
            'address.required'  => 'Vui lòng nhập địa chỉ',
            'fullname.required' => 'Vui lòng nhập tên đầy đủ'



        ];

    }
}
