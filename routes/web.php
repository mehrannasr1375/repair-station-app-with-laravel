<?php
// Auth
use App\Http\Controllers\repairingOrdersController; //testing

Auth::routes();


// Dashboard
Route::get('/', 'DashboardController@index');


// Customers
Route::get('/customers', 'CustomersController@index');
Route::get('/customers/create', 'CustomersController@create');
Route::post('/customers', 'CustomersController@store');
Route::get('/customers/{customer}', 'CustomersController@show');
Route::get('/customers/{customer}/edit', 'CustomersController@edit');
Route::patch('/customers/{customer}', 'CustomersController@update');
Route::delete('/customers/{customer}', 'CustomersController@destroy');
Route::get('/customers/{customer}/orders', 'CustomersController@getOrdersOfCustomer');
Route::get('/customers/{customer}/bills', 'CustomersController@getBillsOfCustomer');



// Orders history
Route::get('/orders', 'OrdersController@index');
Route::get('/orders/count/{count}', 'OrdersController@index');
Route::get('/orders/create', 'OrdersController@create');
Route::post('/orders', 'OrdersController@store');
Route::get('/orders/{order}', 'OrdersController@show');
Route::get('/orders/{order}/edit', 'OrdersController@edit');
Route::patch('/orders/{order}', 'OrdersController@update');
Route::post('/orders/delete/{order}', 'OrdersController@destroy');
Route::post('/orders/get', 'OrdersController@getCustomers');



// Prepaired Orders
Route::get('/prepaired', 'PrepairedOrdersController@index');
Route::get('/prepaired/count/{count}', 'PrepairedOrdersController@index');
Route::post('/prepaired/checkout','prepairedOrdersController@checkOut');
Route::post('/prepaired/addnote', 'prepairedOrdersController@addNote');



// Repairing Orders
Route::get('/repairing', 'RepairingOrdersController@index');
Route::get('/repairing/count/{count}', 'RepairingOrdersController@index');
Route::post('/repairing/healthy','repairingOrdersController@healthy');
Route::post('/repairing/unrepairable', 'repairingOrdersController@unrepairable');
Route::post('/repairing/putoff', 'repairingOrdersController@putoff');
Route::post('/repairing/addnote', 'repairingOrdersController@addNote');
Route::post('/repairing/addrepaired', 'repairingOrdersController@addRepaired');







//Route::get('/testroute', function(){
//    $customers = \App\Customer::where('name', 'like', "%a%")->get()->toArray();
//    $a = 'ab';
//    $customers = \App\Customer::where('name', 'like', "%{$a}%")->get()->toArray();
//    dump( "is object:"  );
//    dump( is_object($customers) );
//    dump( "is array: " );
//    dump( is_array($customers) );
//    dd($customers);
//});
