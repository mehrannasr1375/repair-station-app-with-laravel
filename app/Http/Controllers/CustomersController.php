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
use App\Http\Requests\updateOrderStatusRequest;
use App\Order;
use App\Http\Requests\NewCustomerFromRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\getCustomerOrdersRequest;
use App\Payment;
use Verta;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $count = ($request->count) ? (int)($request->count) : 8; // make pagination costomized with url:'count/x'

        $available_orders = $this->getAvailableOrders();
        $prepaired_orders = $this->getPrepairedOrders();

        if ( strpos(url()->current(), 'return/customers') ) {
            $customers = DB::table('customers')
                ->select('id', 'name','available_orders_count','prepaired_orders_count')
                ->leftjoinSub($available_orders,'available_orders',function($join){
                    $join->on('customers.id', '=', 'available_orders.customer_id');
                })
                ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                    $join->on('customers.id', '=', 'prepaired_orders.customer_id');
                })
                ->where('is_partner', '=', '0')
                ->orderBy('id','DESC')
                ->paginate($count);
        }
        else if ( strpos(url()->current(), 'return/partners') ) {
            $customers = DB::table('customers')
                ->select('id', 'name','prepaired_orders_count','available_orders_count')
                ->leftjoinSub($available_orders,'available_orders',function($join){
                    $join->on('customers.id', '=', 'available_orders.customer_id');
                })
                ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                    $join->on('customers.id', '=', 'prepaired_orders.customer_id');
                })
                ->where('is_partner', '=', '1')
                ->orderBy('id','DESC')
                ->paginate($count);
        }
        else if ( strpos(url()->current(), 'return/all') ) {
            $customers = DB::table('customers')
                ->select('id', 'name','prepaired_orders_count','available_orders_count')
                ->leftjoinSub($available_orders,'available_orders',function($join){
                    $join->on('customers.id', '=', 'available_orders.customer_id');
                })
                ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                    $join->on('customers.id', '=', 'prepaired_orders.customer_id');
                })
                ->orderBy('id','DESC')
                ->paginate($count);
        }
        else {
            $customers = DB::table('customers')
                ->select('id', 'name','prepaired_orders_count','available_orders_count')
                ->leftjoinSub($available_orders,'available_orders',function($join){
                    $join->on('customers.id', '=', 'available_orders.customer_id');
                })
                ->leftjoinSub($prepaired_orders,'prepaired_orders',function($join){
                    $join->on('customers.id', '=', 'prepaired_orders.customer_id');
                })
                ->orderBy('id','DESC')
                ->paginate($count);
        }

        return view('customers.index', compact('customers','count'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(NewCustomerFromRequest $request)
    {
        $data = $request->validated();
        $data['is_partner'] = $request->has('is_partner') ? true:false;
        $data['created_at'] = new Verta(new \DateTime());

        $res = Customer::create($data);

        return redirect("/customers/$res->id/edit")->with('success', 'مشتری جدید با موفقیت ثبت گردید !');
    }

    public function show(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(NewCustomerFromRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $data['is_partner'] = $request->has('is_partner') ? true:false;

        $customer->update($data);

        return redirect("/customers/$customer->id/edit")->with('success', 'تغییرات با موفقیت ذخیره گردید !');
    }

    public function getOrdersOfCustomer(Customer $customer)
    {
        Verta::setStringformat('H:i --- y/n/j');

        $orders = Order::allOrders()->OrderByDesc()->where('customer_id', $customer->id)->paginate(8);

        return view('customers.orders.index', compact('orders','customer'));
    }

    public function getBillsOfCustomer(Customer $customer)
    {
        Verta::setStringformat('H:i y/n/j');

        $orders = Order::where('customer_id', '=', $customer->id)->with('OrderDetails','Payments')->get();

        return view('customers.bills.index', compact('orders','customer'));
    }

    private function getAvailableOrders()
    {
        $available_orders = DB::table('orders')
            ->select('customer_id')
            ->addSelect(DB::raw('COUNT(orders.id) AS available_orders_count'))
            ->where('checkout', '=', false)
            ->groupBy('customer_id');

        return $available_orders;
    }

    private function getPrepairedOrders()
    {
        $prepaired_orders = DB::table('orders')
            ->select('customer_id')
            ->addSelect(DB::raw('COUNT(orders.id) AS prepaired_orders_count'))
            ->Where('status_code', '!=', '0')
            ->groupBy('customer_id');

        return $prepaired_orders;
    }


}

