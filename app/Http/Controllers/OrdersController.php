<?php
namespace App\Http\Controllers;
use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator; // for override error messages, which stores on session; for form validation error appearance
class OrdersController extends Controller
{



    public function index()
    {
        $orders = Order::where('status_code','>=',0)->orderBy('id', 'desc')->paginate(8);
        return view('orders.index', compact('orders'));
    }



    public function create()
    {
        return view('orders.create');
    }



    public function store(Request $request)
    {
        if ( $request->rd_customer_status == 'new' )
        {
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
            DB::beginTransaction();
                $customer_id = Customer::create($data['customer'])->id;
                $data['order']['customer_id'] = (int)$customer_id;
                $order_id = Order::create($data['order'])->id;
            DB::commit();
            session()->flash('success_res', ' ثبت گردید.');
        }


        else if ( $request->rd_customer_status == 'old' )
        {
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

        return redirect('/orders/' . $order_id . '/edit');
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
        if ( $request->rd_customer_status == 'new' ) // update order => with new customer
        {

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
            $data['order']['opened_earlier'] = $request->has('opened_earlier') ? true:false;

            $customer_id = Customer::create($data['customer'])->id;
            $data['order']['customer_id'] = $customer_id;
            $order->update($data['order']);

        }
        else if ( $request->rd_customer_status == 'old' ) // update order => with old customer
        {

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
            $data['order']['opened_earlier'] = $request->has('opened_earlier') ? true:false;

            $order->customer->update($data['customer']);
            $order->update($data['order']);

        }
        return redirect('orders/' . $order->id . '/edit');
    }
























}
