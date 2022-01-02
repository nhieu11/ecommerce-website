<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
        $id = $this->route('user');
        return [
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'name'=>'required|min:5',
            'phone'=>'required',
            'address'=>'required|min:8',
            'password'=>'required|min:6',
            'password_confirmation'=>'required_with:password|same:password|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Không được để trống email',
            'email.unique'=>'Email đã tồn tại',
            'email.email'=>'Email không đúng định dạng',
            'name.required'=>'Không được để trống Họ và tên',
            'name.min'=>'Họ tên không được nhỏ hơn 5 ký tự',
            'phone.required'=>'số điện thoại không được để trống',
            'address.required'=>'địa chỉ không được để trống',
            'address.min'=>'Địa chỉ không được nhỏ hơn 8 ký tự',
            'password.required'=>'Password không được để trống',
            'password.min'=>'Password không được nhỏ hơn 6 ký tự',
        ];
    }

}
