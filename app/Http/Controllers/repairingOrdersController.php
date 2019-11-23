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
use Verta;

class repairingOrdersController extends Controller
{

    public function index(Request $request)
    {
        // customize datetime
        Verta::setStringformat("j / n / y \n H:i");

        // make pagination customized with url:'/repairing/count/x'
        $count = ($request->count) ? (int)($request->count) : 8;

        $orders = Order::RepairingOrders()->orderByDesc()->paginate($count);

        return view('repairing.index', compact('orders', 'count'));
    }



    /* AJAX Requests ------------------------------------------------------------------------------------------------------------------------------------------------*/

    // ajax: device is well
    public function healthy(updateOrderStatusRequest $request)
    {
        // update status_code for order (3=device_is_well)
        Order::where('id',$request->order_id)->update([
            'status_code'=>3
        ]);

        return response($request->order_id, 200);
    }

    // ajax: device is unrepairable
    public function unrepairable(updateOrderStatusRequest $request)
    {
        // update status_code for order (2=device_is_unrepairable)
        Order::where('id',$request->order_id)->update([
            'status_code'=>2
        ]);

        return response($request->order_id, 200);
    }

    // ajax: device has putted off by customer rejection
    public function putoff(updateOrderStatusRequest $request)
    {
        // update status_code for order (4=rejected_by_customer)
        Order::where('id',$request->order_id)->update([
            'status_code'=>4
        ]);

        return response($request->order_id, 200);
    }

    // ajax: add repairing_note
    public function addNote(addOrderNoteRequest $request)
    {
        // update repairing note for device
        Order::where('id',$request->order_id)->update([
            'delivery_note' => $request->note
        ]);

        return response('true', 200);
    }

    // ajax: device has repaired
    public function addRepaired(orderHasRepairedRequest $request)
    {
        $order_id = $request->order_id;
        $order_details_array = $request->array;

        // insert 'order_detail' rows to DB
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

        // update status_code for order (1=repaired)
        Order::where('id', $order_id)->update([
            'status_code' => 1
        ]);

        return response('true', 200);
    }

}
