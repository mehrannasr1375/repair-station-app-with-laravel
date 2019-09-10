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
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\addOrderNoteRequest;
use App\Http\Requests\orderHasRepairedRequest;
use App\Http\Requests\updateOrderStatusRequest;

class repairingOrdersController extends Controller
{


    //show a list of repairing orders
    public function index()
    {
        $orders = Order::RepairingOrders()->orderByDesc()->paginate(8);
        return view('repairing.index', compact('orders'));
    }



    //ajax: device is well
    public function healthy(updateOrderStatusRequest $request)
    {
        Order::where('id',$request->order_id)->update(['status_code'=>3]);
        return response($request->order_id, 200);
    }



    //ajax: device is unrepairable
    public function unrepairable(updateOrderStatusRequest $request)
    {
        Order::where('id',$request->order_id)->update(['status_code'=>2]);
        return response($request->order_id, 200);
    }



    //ajax: device has putted off
    public function putoff(updateOrderStatusRequest $request)
    {
        Order::where('id',$request->order_id)->update(['status_code'=>4]);
        return response($request->order_id, 200);
    }



    //ajax: add repairing_note
    public function addNote(addOrderNoteRequest $request)
    {
        Order::where('id',$request->order_id)->update(['delivery_note'=>$request->note]);
        return response('true', 200);
    }



    //ajax: device has repaired
    public function addRepaired(orderHasRepairedRequest $request)
    {
        $order_id = $request->order_id;
        $order_details_array = $request->array; //turn the json string to array

        //insert into order_details table in a for loop
        for ($i=0; $i<count($order_details_array); $i++) {
            $cost_title = $order_details_array[$i][0];
            $cost_user  = $order_details_array[$i][1];
            $cost_shop  = $order_details_array[$i][2];
            OrderDetail::create([
                'order_id'     =>  $order_id,
                'key'          =>  $cost_title,
                'user_amount'  =>  $cost_user,
                'shop_amount'  =>  $cost_shop,
            ]);
        }

        //update status_code
        Order::where('id', $order_id)->update(['status_code' => 1]);

        return response('true', 200);
    }




















}
