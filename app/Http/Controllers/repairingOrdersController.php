<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class repairingOrdersController extends Controller
{

    public function index()
    {
        $orders = Order::where('status_code', 0)->orderBy('id', 'desc')->paginate(10);
        return view('repairing.index', compact('orders'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }


    public function healthy(Request $request, Order $order)
    {

        if ($request->ajax()) {
            /*$data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);*/
        }

        return view('productAjax',compact('products'));

        dd($order);

    }

}
