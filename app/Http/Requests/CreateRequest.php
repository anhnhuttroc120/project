<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
                'username'=>'required|unique:users,username','email'=>'required|unique:users,email|email','address'=>'required','phone'=>'numeric|required','password'=>'required','re-pasword'=>'same:password'
        ];
    }
         public function messages(){
        return ['username.required'=>'Vui lòng nhập tên tài khoản','username.unique'=>'Tên tài khoản đã tồn tại','email.required'=>'Vui lòng nhập email','email.unique'=>'Email đã tồn tại','email.email'=>'Không phải định dạng email','address.required'=>'Vui lòng nhập địa chỉ','phone.required'=>'Vui lòng nhập số điện thoại','phone.numeric'=>'Không phải định dạng số điện thoại','password.required'=>'Vui lòng nhập mật khẩu','re-password.same'=>'Mật khẩu nhập không khớp'];
    }
    // public function messages(){
    //     return [
    //             'username.required'=>'Vui lòng nhập tên tài khoản','username.unique'=>'Tên tài khoản đã tồn tại','email.required'=>'Vui lòng nhập email','email.unique'=>'Email đã tồn tại,Vui lòng chọn email khác','email.email'=>'Định dạng này không phải là định dạng email','address'=>'Vui lòng nhập địa chỉ','password.required'=>'Vui lòng nhập password','phone.required'=>'Vui lòng nhập số điện thoại ','phone.numeric'=>'Số điện thoại phải là số','re-pasword.same'=>'Mật khẩu không trùng khớp';
    //     ];
    // }

    
}
