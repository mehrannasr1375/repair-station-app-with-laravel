<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class NewOrderFormRequest extends FormRequest
{
    
    

    public function rules()
    {
        return [
            'device_type' => '',
            'device_brand' => '',
            'device_model' => '',
            'problem' => 'required',
            'problem_details' => '',
            'opened_earlier' => '',
            'participants_csv' => '',

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
            'problem.required' => 'نوشتن عیب تعمیری الزامی است !',
            'name.required' => 'نوشتن نام مشتری الزامی است !',
            'name.min' => 'نام مشتری باید شامل حداقل 3 کاراکتر باشد !',
        ];
    }



}
