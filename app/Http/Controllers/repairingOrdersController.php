<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class repairingOrdersController extends Controller
{


    //show a list of repairing orders
    public function index()
    {
        $orders = Order::where('status_code', 0)->orderBy('id', 'desc')->paginate(10);
        return view('repairing.index', compact('orders'));
    }



    //ajax: device is well
    public function healthy(Request $request)
    {
        if ( $request->ajax() )
        {
            $data = $request->validate(['hidden_order_id' => 'required|numeric']);
            Order::where('id', $data)->update(['status_code' => 3]);
            return 'true';
        }
    }


}
