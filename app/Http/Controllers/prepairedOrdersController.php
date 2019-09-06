<?php
/*
*  0 : repairing
*  1 : repaired
*  2 : not repairable
*  3 : no problem
*  4 : rejected by customer
*/
namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class prepairedOrdersController extends Controller
{

    public function index()
    {
        $orders = Order::prepairedOrders()->undeliveredOrders()->orderByDesc()->paginate(8);
        return view('prepaired.index', compact('orders'));
    }



    public function checkout(Request $request)
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

        // do enother things (like payments) here

        Order::where('id',$request->order_id)->update(['checkout'=>true]);
        return response()->json(['order_id'=>$request->order_id],200);
    }




















}
