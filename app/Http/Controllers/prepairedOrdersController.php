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
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\updateOrderStatusRequest;
use App\Http\Requests\addOrderNoteRequest;

class prepairedOrdersController extends Controller
{


    public function index()
    {
        $orders = Order::prepairedOrders()->undeliveredOrders()->orderByDesc()->paginate(8);
        return view('prepaired.index', compact('orders'));
    }



    public function checkOut(updateOrderStatusRequest $request)
    {
        $order_id = $request->order_id;
        $payments_array = $request->array; //turn the json string to array

        //insert into payments table in a for loop
        for ($i=0; $i<count($payments_array); $i++) {
            $amount = $payments_array[$i][0];
            $payment_type  = $payments_array[$i][1];
            Payment::create([
                'order_id'      =>  $order_id,
                'amount'        =>  $amount,
                'payment_type'  =>  $payment_type,
            ]);
        }

        Order::where('id',$order_id)->update(['checkout' => true]);
        return response($request->order_id, 200);
    }



    public function addNote(addOrderNoteRequest $request)
    {
        Order::where('id',$request->order_id)->update(['delivery_note'=>$request->note]);
        return response('true', 200);
    }
















}
