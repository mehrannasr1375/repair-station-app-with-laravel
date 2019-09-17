<?php
namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class getCustomerOrdersRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer_id'=>'required|numeric',
        ];
    }



    public function messages()
    {
        return [
            'customer_id.required' => 'سریال مشتری ارسال شده معتبر نیست!',
            'customer_id.numeric' => 'دیتای ارسال شده نامعتبر است!',
        ];
    }
}
