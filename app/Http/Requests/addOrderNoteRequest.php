<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class addOrderNoteRequest extends FormRequest
{



    public function rules()
    {
        return [
            'order_id'=>'required|numeric',
            'note'=>'required',
        ];
    }



    public function messages()
    {
        return [
            'order_id.required' => 'سریال تعمیری الزامی است!',
            'order_id.numeric' => 'سریال تعمیری ارسال شده معتبر نیست!',
            'note.required' => 'متن یادداشت نمی تواند خالی باشد!',
        ];
    }



    public function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }



    //change '402 status code' for response (for ajax requests)
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()->all()], 200));
    }






























}
