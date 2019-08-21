<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{


    public function index()
    {
        $partners  = Customer::where('is_partner', 1)->orderBy('id', 'desc')->paginate(4);
        $customers = Customer::where('is_partner', 0)->orderBy('id', 'desc')->paginate(4);
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


    
}

