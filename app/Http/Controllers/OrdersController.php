<?php
namespace App\Http\Controllers;
use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Contracts\Validation\Validator; // for override error messages, which stores on session; for form validation error appearance
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\NewOrderFormRequest;
use Hamcrest\Type\IsInteger;
use Verta;

class OrdersController extends Controller
{



    public function index() //ok
    {

        Verta::setStringformat('j / n / y H:i');

        $orders = Order::allOrders()->OrderByDesc()->with('Payments', 'OrderDetails', 'customer')->paginate(8);

        $this->aggregatePricesSum($orders);

        return view('orders.index', compact('orders'));

    }



    public function create() //ok
    {

        Verta::setStringformat("j / n / y");

        return view('orders.create');

    }



    public function store(Request $request) //ok
    {

        if ( $request->rd_customer_status == 'old' ) {
            $order_id = $this->newOrderOfExistingCustomer($request);
            return redirect("/orders/$order_id/edit")->with('success_res', ' ثبت گردید.');
        }
        else {
            $order_id = $this->newOrderOfNewCustomer($request);
            return redirect("/orders/$order_id/edit")->with('success_res', ' تعمیری با موفقیت ثبت گردید.');
        }

    }



    public function show(Order $order) //ok
    {

        return view('orders.edit', compact('order'));

    }



    public function edit(Order $order) //ok
    {

        $order_details = $order->orderDetails;
        $payments      = $order->payments;

        $this->aggregatePricesSum(array($order));

        return view('orders.edit', compact('order','order_details','payments'));

    }



    public function update(Request $request, Order $order) //ok
    {

        if ( $request->rd_customer_status == 'new' ) // update order => with new customer
        {
            $messages = [
                'name.required' => 'وارد کردن نام مشتری الزامی است !',
                'problem.required' => 'وارد کردن ایراد تعمیری الزامی است !',
            ];
            $validator1 = validator::make($request->all(), [
                'name' => 'required',
                'problem' => 'required',
            ], $messages);
            if ( $validator1->fails() )
                return back()->withErrors($validator1)->withInput();

            $data['customer'] =  [
                'name'       => $request->name,
                'is_partner' => $request->has('is_partner') ? true:false,
                'created_at' => new Verta(new \DateTime()),
                'tell_1'     => $request->tell_1,
                'mobile_1'   => $request->mobile_1,
                'address'    => $request->address,
            ];
            $data['order']    =  [
                'device_type'      => $request->device_type,
                'device_brand'     => $request->device_brand,
                'device_model'     => $request->device_model,
                'receive_date'     => $request->receive_date,
                'problem'          => $request->problem,
                'problem_details'  => $request->problem_details,
                'opened_earlier'   => $request->has('opened_earlier') ? true:false,
                'participants_csv' => $request->participants_csv,
            ];

            $customer_id = Customer::create($data['customer'])->id;
            $data['order']['customer_id'] = $customer_id;
            $order->update($data['order']);
        }

        else if ( $request->rd_customer_status == 'old' ) // update order => with old customer
        {

            $messages = [
                'old_customer_id.required' => 'وارد کردن شناسه مشتری الزامی است !',
                'old_customer_id.numeric'  => 'شناسه مشتری باید عددی باشد !',
                'problem.required'         => 'وارد کردن ایراد تعمیری الزامی است !',
            ];
            $validator2 = validator::make($request->all(), [
                'problem' => 'required',
                'old_customer_id' => 'numeric|required',
            ], $messages);
            if ( $validator2->fails() )
                return back()->withErrors($validator2)->withInput();

            $data['order'] = [
                'customer_id'      => $request->old_customer_id,
                'device_type'      => $request->device_type,
                'device_brand'     => $request->device_brand,
                'device_model'     => $request->device_model,
                'receive_date'     => $request->receive_date,
                'problem'          => $request->problem,
                'problem_details'  => $request->problem_details,
                'opened_earlier'   => $request->has('opened_earlier') ? true:false,
                'participants_csv' => $request->participants_csv,
            ];

            $customer = Customer::find($request->old_customer_id);

            if ( $customer->first() )
                $order->update($data['order']);

        }

        return redirect("orders/$order->id/edit")->with('success_res', ' اطلاعات تعمیری با موفقیت بروزرسانی شد.');

    }



    public function destroy(Order $order) //ajax //ok
    {

        $order->delete();

        return response('true', 200);

    }



    /*------------------------------------------------------------------------------------------------------------------------------------------*/



    // calculate 'paid' && 'should_pay' && 'sum' amount for order
    public function aggregatePricesSum($orders) //ok
    {

        foreach ($orders as $order) {
            $paid_sum = 0;
            foreach ($order->Payments as $payment) {
                $paid_sum += (int)($payment->amount);
            }
            $order->paid = $paid_sum;
            $should_pay_sum = 0;
            foreach ($order->OrderDetails as $orderDetail) {
                $should_pay_sum += (int)($orderDetail->user_amount);
            }
            $order->should_pay = $should_pay_sum;
            $order->debt_status = 0;
            $order->debt_status = $order->should_pay - $order->paid;
        }

    }



    // get customers for create new order of existing customer via ajax
    public function getCustomers(Request $request) //ajax
    {

        if ( $request->type == 'id' )
        {
            $id = (int)($request->id);
            $customer = Customer::where('id', '=', $id)->first();
            if ( $customer->first() ) {
                return response(json_encode($customer), 200);
            } else {
                return response('false', 200);
            }
        }
        else if ( $request->type == 'name' )
        {
            $name = $request->name;
            if ( $name == "" ) {
                return response('false', 200);
            }
            $customers = Customer::where('name', 'like', "%{$name}%")->get();

            /*

                If you dd($customers); you'll notice an instance of 'Illuminate\Support\Collection'
                is always returned, even when there are no results.

                If you return an Eloquent object with ajax, it will be represented as JSON (perfect for APIs)

                So you should do any of the following:
                        if ($result->first()) { }
                        if (!$result->isEmpty()) { }
                        if ($result->count()) { }

                the  '->first()'  or  '->get()'  expressions will
                returns an 'array' and if there is no results, returns  'null'

            */
            if ( $customers->first() ) {
                return response(json_encode($customers->toArray()), 200);
            } else {
                return response('false', 200);
            }
        }

    }



    /*------------------------------------------------------------------------------------------------------------------------------------------*/



    public function newOrderOfNewCustomer($request) //ok
    {

        $messages = [
            'name.required' => 'وارد کردن نام مشتری الزامی است !',
            'problem.required' => 'وارد کردن ایراد تعمیری الزامی است !',
        ];
        $validator1 = validator::make($request->all(), [
            'name' => 'required',
            'problem' => 'required',
        ], $messages);
        if ( $validator1->fails() )
            return redirect('orders/create')->withErrors($validator1)->withInput();

        $data['customer'] = [
            'name'       => $request->name,
            'is_partner' => $request->has('is_partner') ? true:false,
            'created_at' => new Verta(new \DateTime()),
            'tell_1'     => $request->tell_1,
            'mobile_1'   => $request->mobile_1,
            'address'    => $request->address,
        ];
        $data['order']    = [
            'device_type'      => $request->device_type,
            'device_brand'     => $request->device_brand,
            'device_model'     => $request->device_model,
            'receive_date'     => new Verta(new \DateTime()),
            'problem'          => $request->problem,
            'problem_details'  => $request->problem_details,
            'opened_earlier'   => $request->has('opened_earlier') ? true:false,
            'participants_csv' => $request->participants_csv,
        ];

        DB::beginTransaction();
            $customer_id = Customer::create($data['customer'])->id;
            $data['order']['customer_id'] = $customer_id;
            $order_id = Order::create($data['order'])->id;
        DB::commit();

        return $order_id;

    }



    public function newOrderOfExistingCustomer($request) //ok
    {

        $messages = [
            'old_customer_id.required' => 'وارد کردن شناسه مشتری الزامی است !',
            'problem.required' => 'وارد کردن ایراد تعمیری الزامی است !',
            'old_customer_id.numeric' => 'شناسه مشتری باید عددی باشد !',
        ];
        $validator2 = validator::make($request->all(), [
            'old_customer_id' => 'required|numeric',
            'problem' => 'required',
        ], $messages);
        if ( $validator2->fails() )
            return redirect('orders/create')->withErrors($validator2)->withInput();

        $customer = Customer::find($request->old_customer_id);
        if ( $customer->first() ) {
            $data['order'] = [
                'customer_id'      => $request->old_customer_id,
                'device_type'      => $request->device_type,
                'device_brand'     => $request->device_brand,
                'device_model'     => $request->device_model,
                'receive_date'     => new Verta(new \DateTime()),
                'problem'          => $request->problem,
                'problem_details'  => $request->problem_details,
                'opened_earlier'   => $request->has('opened_earlier') ? true:false,
                'participants_csv' => $request->participants_csv,
            ];
            $order_id = Order::create($data['order'])->id;
        }

        return $order_id;

    }



}
