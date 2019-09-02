<?php
namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Validator;
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
        $validated_data = $request->validate([
            'order_id'=>'required|numeric',
        ]);
        Order::where('id',$validated_data)->update(['status_code'=>3]);
        return response()->json(['order_id'=> $request->order_id],200);
    }

















}
