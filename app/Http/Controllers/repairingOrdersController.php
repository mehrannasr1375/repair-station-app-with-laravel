<?php
namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class repairingOrdersController extends Controller
{


    //show a list of repairing orders
    public function index()
    {
        $orders = Order::where('status_code', 0)->orderBy('id', 'desc')->paginate(8);
        return view('repairing.index', compact('orders'));
    }



    //ajax: device is well
    public function healthy(Request $request)
    {
        /*
            در درخواستهای ایجکس
            لاراول در صورتی که خطا در داده های مورد ارزیابی وجود داشته باشد
            هیچ ریدایرکتی ایجاد نمیکند
            اما در عوض خطاهای ایجاد شده را در قالب جیسون به همراه کد وضعیت 442 = خطای داخلی سرور به مرورگر برمیگرداند
            بنابراین در درخواست های ایجکس باید چه در صورت موفقیت امیز بودن و چه نبودن اعتبارسنجی
            نتیجه را به مرورگر بازگشت دهیم
            :مثلا
            true یا false
            را برگردانیم
        */

        //make custom validator with custom error messages
        $messages = [
            'order_id.required' => 'خطا: انتخاب تعمیری با سریال الزامی است',
            'order_id.numeric' => 'خطا: دیتای ارسال شده نامعتبر است',
        ];
        $validator = Validator::make($request->all(), [
            'order_id'=>'required|numeric',
        ], $messages);

        //on failure validation: send error in json to client
        if ( $validator->fails() ) {
            return  $validator->errors()->first('order_id');
        }

        //run on successfull validation: send updated 'order_id' to client
        Order::where('id',$request->order_id)->update(['status_code'=>3]);
        return response()->json(['order_id'=> $request->order_id],200);

    }




    //ajax: device is unrepairable
    public function unrepairable(Request $request)
    {

        $messages = [
            'order_id.required' => 'خطا: انتخاب تعمیری با سریال الزامی است',
            'order_id.numeric' => 'خطا: دیتای ارسال شده نامعتبر است',
        ];
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric'
        ], $messages);

        if ( $validator->fails() ) {
            return $validator->errors()->first('order_id');
        }

        Order::where('id',$request->order_id)->update(['status_code'=>2]);
        return response()->json(['order_id'=>$request->order_id],200);

    }




    //ajax: device is putted off
    public function putoff(Request $request)
    {
        
        $messages = [
            'order_id.required' => 'خطا: انتخاب تعمیری با سریال الزامی است',
            'order_id.numeric' => 'خطا: دیتای ارسال شده نامعتبر است',
        ];
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric'
        ], $messages);

        if ( $validator->fails() ) {
            return $validator->errors()->first('order_id');
        }

        Order::where('id',$request->order_id)->update(['status_code'=>4]);
        return response()->json(['order_id'=>$request->order_id],200);

    }

















}
