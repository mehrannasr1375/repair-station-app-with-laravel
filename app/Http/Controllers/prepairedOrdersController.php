<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class prepairedOrdersController extends Controller
{
    
    public function index()
    {
        $orders = Order::where('status_code',1)
                        ->orWhere('status_code',2)
                        ->orWhere('status_code',3)
                        ->orWhere('status_code',4)
                        ->orderBy('id', 'desc')
                        ->paginate(10);
        return view('prepaired.index', compact('orders'));
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
}
