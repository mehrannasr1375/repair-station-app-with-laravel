<?php
namespace App\Http\Controllers;
use App\Http\Requests\updateOrderStatusRequest;
use App\Order;
use App\Customer;
use App\OrderDetail;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\NewOrderFormRequest;
use Hamcrest\Type\IsInteger;
use Verta;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        Verta::setStringformat('j / n / y H:i');

        $count = ($request->count) ? (int)($request->count) : 9;

        $orders = Order::allOrders()->OrderByDesc()->with('Payments', 'OrderDetails', 'customer')->paginate($count);

        $this->aggregatePricesSum($orders);

        return view('orders.index', compact('orders','count'));
    }

    public function create()
    {
        Verta::setStringformat("j / n / y");

        return view('orders.create');
    }

    public function store(Request $request)
    {
        if ( $request->rd_customer_status == 'old' ) {
            $validator2 = validator::make($request->all(), [
                'old_customer_id' => 'required|numeric',
                'problem' => 'required',
            ], [
                'old_customer_id.required' => 'وارد کردن شناسه مشتری الزامی است !',
                'problem.required' => 'وارد کردن ایراد تعمیری الزامی است !',
                'old_customer_id.numeric' => 'شناسه مشتری باید عددی باشد !',
            ]);
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
            return redirect("/orders/$order_id/edit/")->with('success_res', ' ثبت گردید.');
        }
        else {
            $validator1 = validator::make($request->all(), [
                'name' => 'required',
                'problem' => 'required',
            ], [
                'name.required' => 'وارد کردن نام مشتری الزامی است !',
                'problem.required' => 'وارد کردن ایراد تعمیری الزامی است !',
            ]);
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
            $data['order'] = [
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
            return redirect("/orders/$order_id/edit/")->with('success_res', ' تعمیری با موفقیت ثبت گردید.');
        }
    }

    public function show(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function edit(Order $order)
    {
        $order_details = $order->orderDetails;
        $payments      = $order->payments;

        //$this->aggregatePricesSum(array($order));

        return view('orders.edit', compact('order','order_details','payments'));
    }

    public function update(Request $request, Order $order)
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

            // delete all old 'order_details' & 'payments'
            $order->orderDetails()->delete();
            $order->payments()->delete();

            // insert new 'order_details' & 'payments' to DB
            for ($i=0; $i<@count($request->order_detail_key) ; $i++) {
                if ($request->order_detail_key[$i] != '') {
                    OrderDetail::create([
                        'order_id'     => $request->order_id,
                        'key'          => $request->order_detail_key[$i],
                        'user_amount'  => $request->order_detail_user_amount[$i],
                        'shop_amount'  => $request->order_detail_shop_amount[$i],
                    ]);
                }
            }
            for ($i=0; $i<@count($request->payment_amount); $i++) {
                if ($request->payment_amount[$i] != '') {
                    Payment::create([
                        'order_id'     => $request->order_id,
                        'amount'       => $request->payment_amount[$i],
                        'payment_type' => $request->payment_type[$i],
                        'date'         => $request->payment_date[$i],
                    ]);
                }
            }

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

            // delete all old 'order_details' & 'payments'
            $order->orderDetails()->delete();
            $order->payments()->delete();

            // insert new 'order_details' & 'payments' to DB
            for ($i=0; $i<@count($request->order_detail_key) ; $i++) {
                if ($request->order_detail_key[$i] != '') {
                    OrderDetail::create([
                        'order_id'     => $request->order_id,
                        'key'          => $request->order_detail_key[$i],
                        'user_amount'  => $request->order_detail_user_amount[$i],
                        'shop_amount'  => $request->order_detail_shop_amount[$i],
                    ]);
                }
            }
            for ($i=0; $i<@count($request->payment_amount); $i++) {
                if ($request->payment_amount[$i] != '') {
                    Payment::create([
                        'order_id'     => $request->order_id,
                        'amount'       => $request->payment_amount[$i],
                        'payment_type' => $request->payment_type[$i],
                        'date'         => $request->payment_date[$i],
                    ]);
                }
            }

            $customer = Customer::find($request->old_customer_id);

            if ( $customer->first() )
                $order->update($data['order']);
        }

        return redirect("orders/$order->id/edit")->with('success_res', ' اطلاعات تعمیری با موفقیت بروزرسانی شد.');
    }

    public function destroy(Order $order)
    {
        //delete via ajax with route model binding on url

        $order->delete();

        return response('true', 200);
    }



    // Aggregate with ORM ---------------------------------------------------------------------------------------------------------------
    public function aggregatePricesSum($orders)
    {
        // calculate 'paid' && 'should_pay' && 'sum' amount for order
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



    // Ajax Requests ----------------------------------------------------------------------------------------------------------------------------
    public function getCustomers(Request $request)
    {
        // get customers for create new order of existing customer via ajax

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

    public function addPayment(updateOrderStatusRequest $request)
    {
        $order_id        =  $request->order_id;
        $payments_array  =  $request->array;

        for ($i=0; $i<count($payments_array); $i++) {
            $amount        =  $payments_array[$i][0];
            $payment_type  =  $payments_array[$i][1];
            Payment::create([
                'order_id'      =>  $order_id,
                'amount'        =>  $amount,
                'payment_type'  =>  $payment_type,
                'date'         =>  new Verta(new \DateTime()),
            ]);
        }

        return response('true', 200);
    }



}
