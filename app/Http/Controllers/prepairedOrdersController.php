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
use App\Http\Requests\updateOrderStatusRequest;

class prepairedOrdersController extends Controller
{


    public function index()
    {
        $orders = Order::prepairedOrders()->undeliveredOrders()->orderByDesc()->paginate(8);
        return view('prepaired.index', compact('orders'));
    }



    public function checkOut(updateOrderStatusRequest $request)
    {
        // update payments table

        Order::where('id',$request->order_id)->update(['checkout' => true]);
        return response($request->order_id, 200);
    }




















}
