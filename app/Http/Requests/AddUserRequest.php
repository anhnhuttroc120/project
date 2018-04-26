<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
           'username'=>'required|unique:users,username',
           'fullname'=>'required',
           'email'=>'required|unique:users,email',
           'password'=>'required',
           're-password'=>'same:password',
           'phone'=>'required|min:10|max:11',
           'address'=>'required'
        ];
    }
}
