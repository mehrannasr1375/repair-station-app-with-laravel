<?php
/*
*  0 : repairing
*  1 : repaired
*  2 : not repairable
*  3 : no problem
*  4 : rejected by customer
*/
namespace App\Http\Controllers;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\getCustomerOrdersRequest;

class CustomersController extends Controller
{


    public function index()
    {

        $available_orders = DB::table('orders')
            ->select('customer_id')
            ->addSelect(DB::raw('COUNT(orders.id) AS available_orders_count'))
            ->where('checkout','=',false)
            ->groupBy('customer_id');
        $prepaired_orders = DB::table('orders')
            ->select('customer_id')
            ->addSelect(DB::raw('COUNT(orders.id) AS prepaired_orders_count'))
            ->Where('status_code','!=','0')
            ->groupBy('customer_id');


        $partners = DB::table('customers')
            ->select('id', 'name','prepaired_orders_count','available_orders_count')
            ->leftjoinSub($available_orders,'available_orders',function($join){
                $join->on('customers.id', '=', 'available_orders.customer_id');
            })
            ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                $join->on('customers.id', '=', 'prepaired_orders.customer_id');
            })
            ->where('is_partner', '=', true)
            ->paginate(8);


        $customers = DB::table('customers')
            ->select('id', 'name','available_orders_count','prepaired_orders_count')
            ->leftjoinSub($available_orders,'available_orders',function($join){
                $join->on('customers.id', '=', 'available_orders.customer_id');
            })
            ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                $join->on('customers.id', '=', 'prepaired_orders.customer_id');
            })
            ->where('is_partner', '=', false)
            ->paginate(8);

//        dd($customers->toArray());

        return view('customers.index', compact('customers','partners'));
    }



    public function create()
    {
        return view('customers.create');
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'is_partner' => '',
            'tell_1' => '',
            'tell_2' => '',
            'mobile_1' => '',
            'mobile_2' => '',
            'address' => ''
        ]);
        $data['is_partner'] = $request->has('is_partner') ? true:false;
        Customer::create($data);
        return redirect('/customers');
    }



    public function show(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }



    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }



    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'is_partner' => '',
            'tell_1' => '',
            'tell_2' => '',
            'mobile_1' => '',
            'mobile_2' => '',
            'address' => ''
        ]);
        $data['is_partner'] = $request->has('is_partner') ? true:false;
        $customer->update($data);
        return redirect('/customers/' . $customer->id . '/edit');
    }



    public function destroy(Customer $customer)
    {
        //$customer->delete();
        return redirect('/customers');
    }



    public function getOrdersOfCustomer(Customer $customer)
    {
        $orders = Order::allOrders()->OrderByDesc()->where('customer_id', $customer->id)->paginate(8);
        return view('customers.orders.index', compact('orders'));
    }















}

