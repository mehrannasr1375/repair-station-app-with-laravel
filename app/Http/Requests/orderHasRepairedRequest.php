<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class orderHasRepairedRequest extends FormRequest
{


    public function rules()
    {
        return [
            'order_id'=>'required|numeric',
            'array'=>'',
        ];
    }



    public function messages()
    {
        return [
            'order_id.required' => 'سریال تعمیری ارسال شده معتبر نیست!',
            'order_id.numeric' => 'دیتای ارسال شده نامعتبر است!',
        ];
    }



    //change '402 status code' for response (for ajax requests)
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()->all()], 200));
    }





























}
