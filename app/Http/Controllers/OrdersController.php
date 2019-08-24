<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator; // for override error messages, which stores on session; for form validation error appearance

class OrdersController extends Controller
{
    
    public function index()
    {
        $orders = Order::where('status_code','>=',0)->orderBy('id', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }


    
    public function create()
    {
        return view('orders.create');        
    }

   

    public function store(Request $request)
    {
        if ( $request->rd_customer_status == 'new' ) {
            $data['customer'] = $request->validate([
                'name' => 'required|min:3',
                'is_partner' => '',
                'tell_1' => '',
                'tell_2' => '',
                'mobile_1' => '',
                'mobile_2' => '',
                'address' => '',
            ]);
            $data['order'] = $request->validate([
                'device_type' => '',
                'device_brand' => '',
                'device_model' => '',
                'device_serial' => '',
                'receive_date' => '',
                'problem' => 'required',
                'problem_details' => '',
                'opened_earlier' => '',
                'participants_csv' => '',
            ]);

            $customer_id = Customer::create($data['customer'])->id;
            $data['order']['customer_id'] = (int)$customer_id;
            $order_id = Order::create($data['order'])->id;
            session()->flash('success_res', ' ثبت گردید.');
        }


        else if ( $request->rd_customer_status == 'old' ) {
            $data['order'] = $request->validate([
                'customer_id' => 'required',
                'device_type' => '',
                'device_brand' => '',
                'device_model' => '',
                'device_serial' => '',
                'device_date' => '',
                'already_repaired' => '',
                'problem' => 'required',
                'problem_details' => '',
                'participants_csv' => '',
            ]);
            // check and get customer.id
            //save to orders
            session()->flash('success_res', ' ثبت گردید.');
        }

        return redirect('/orders/'. $order_id .'/edit');
    }


    
    public function show(Order $order)
    {       
        return view('orders.edit', compact('order'));
    }
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }


    
    public function update(Request $request, Order $order)
    {
        
    }

    

    public function destroy(Order $order)
    {
        
    }

}
