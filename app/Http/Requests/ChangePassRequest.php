<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChangePassRequest extends FormRequest
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
        return ['password_old'=>'required|password_old:'.Auth::user()->password,'password_new'=>'required','re-password'=>'same:password_new'];

    }
   public function messages()
   {
    return [
            'password_old.password_old' => 'Mật khẩu cũ không đúng',
            'password_old.required'    => 'Vui lòng nhập mật khẩu cũ',
            'password_new.required'     => 'Vui lòng nhập mật khẩu mới',
            're-password.same'      =>'Mật khẩu nhập không khớp'

        ];
   }
}
