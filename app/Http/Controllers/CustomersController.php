<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{


    public function index()
    {
        $partners = Customer::where('is_partner',1)->paginate(4);
        $customers = Customer::where('is_partner',0)->paginate(4);
        return view('customers.index', compact('customers','partners'));
    }



    public function create()
    {
        return view('customers.create');
    }



    public function store(Request $request)
    {
        $data = $request->validete([
            '' => '',
        ]);
        Customer::create($data);
        return redirect('/customers');
    }



    public function show(Customer $customer)
    {
        
    }



    public function edit(Customer $customer)
    {
        
    }



    public function update(Request $request, Customer $customer)
    {
        
    }



    public function destroy(Customer $customer)
    {
        
    }


    
}

