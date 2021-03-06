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
use Verta;

class prepairedOrdersController extends Controller
{

    public function index(Request $request)
    {
        $count = ($request->count) ? (int)($request->count) : 8;

        $orders = Order::prepairedOrders()->undeliveredOrders()->orderByDesc()->with('OrderDetails','customer')->paginate($count);

        // calculate 'total_cost' for each order (equals with: join and aggregate in database level)
        foreach ($orders as $order) {
            $sum = 0;
            foreach ($order->OrderDetails as $order_detail) {
                $sum += (int)($order_detail->user_amount);
            }
            $order->total_cost = $sum;
        }

        return view('prepaired.index', compact('orders', 'count'));
    }



    /* AJAX Requests------------------------------------------------------------------------------------------------------------------------------------------------*/

    // ajax for checkout order
    public function checkOut(updateOrderStatusRequest $request)
    {
        $order_id        =  $request->order_id;
        $payments_array  =  $request->array;

        for ($i=0; $i<count($payments_array); $i++) {
            $amount        =  $payments_array[$i][0];
            $payment_type  =  $payments_array[$i][1];
            if ($amount != 0) {
                Payment::create([
                    'order_id'      =>  $order_id,
                    'amount'        =>  $amount,
                    'payment_type'  =>  $payment_type,
                    'date'         =>  new Verta(new \DateTime()),
                ]);
            }
        }

        Order::where('id', $order_id)->update([
            'checkout' => true
        ]);

        return response($request->order_id, 200);
    }

    // ajax for add order note
    public function addNote(addOrderNoteRequest $request) //ok
    {
        Order::where('id',$request->order_id)->update([
            'delivery_note' => $request->note
        ]);

        return response('true', 200);
    }

}
