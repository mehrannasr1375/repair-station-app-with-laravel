<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{


    // Display a listing of the resource.
    public function index()
    {
        $customers = Customer::all();
        //dd($customers);
        return view('customers.index', compact('customers'));
    }



    // Show the form for creating a new resource.
    public function create()
    {
        
    }



    // Store a newly created resource in storage.
    // @param  \Illuminate\Http\Request  $request
    public function store(Request $request)
    {
        
    }



    // Display the specified resource.
    // @param  \App\Customer  $customer
    public function show(Customer $customer)
    {
        
    }



    // Show the form for editing the specified resource.
    // @param  \App\Customer  $customer
    public function edit(Customer $customer)
    {
        
    }



    // Update the specified resource in storage.
    // @param  \Illuminate\Http\Request  $request
    // @param  \App\Customer  $customer
    public function update(Request $request, Customer $customer)
    {
        
    }



    // Remove the specified resource from storage.
    // @param  \App\Customer  $customer
    public function destroy(Customer $customer)
    {
        
    }


    
}

