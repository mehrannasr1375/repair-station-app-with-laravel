<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class newUserFormRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'نوشتن نام الزامی است !',
            'name.min' => 'نام باید شامل حداقل 3 کاراکتر باشد !',
            'name.unique' => 'این نام کاربری قبلا استفاده شده است !',
            'email.required' => 'نوشتن ایمیل الزامی است !',
            'email.unique' => 'این ایمیل قبلا استفاده شده است !',
            'email.email' => 'ایمیل نامعتبر است !',
            'password.min' => 'رمز عبور باید شامل حداقل 4 کاراکتر باشد !',
            'password.required' => 'نوشتن پسورد الزامی است !',
        ];
    }

}
