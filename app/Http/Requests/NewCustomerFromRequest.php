<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class NewCustomerFromRequest extends FormRequest
{



    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'is_partner' => '',
            'tell_1' => '',
            'mobile_1' => '',
            'address' => '',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'نوشتن نام مشتری الزامی است !',
            'name.min' => 'نام مشتری باید شامل حداقل 3 کاراکتر باشد !',
        ];
    }
}
