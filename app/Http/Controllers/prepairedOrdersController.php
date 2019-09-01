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
                        ->paginate(8);
        return view('prepaired.index', compact('orders'));
    }




















}
