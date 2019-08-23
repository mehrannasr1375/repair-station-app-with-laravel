<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

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
