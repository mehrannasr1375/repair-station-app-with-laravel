<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function index()
    {
        $orders = Order::where('status_code',1)->orderBy('id', 'desc')->paginate(5);
        return view('orders.index', compact('orders'));
    }


    
    public function create()
    {
        
    }

   

    public function store(Request $request)
    {
        
    }


    
    public function show(Order $order)
    {
        
    }


    
    public function edit(Order $order)
    {
        
    }


    
    public function update(Request $request, Order $order)
    {
        
    }

    

    public function destroy(Order $order)
    {
        
    }

}
