<?php
// Auth
use App\Http\Controllers\repairingOrdersController;

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

// Orders history
Route::get('/orders', 'OrdersController@index');
Route::get('/orders/create', 'OrdersController@create');
Route::post('/orders', 'OrdersController@store');
Route::get('/orders/{order}', 'OrdersController@show');
Route::get('/orders/{order}/edit', 'OrdersController@edit');
Route::patch('/orders/{order}', 'OrdersController@update');

// Prepaired Orders
Route::get('/prepaired', 'PrepairedOrdersController@index');
Route::post('/prepaired/checkout','prepairedOrdersController@checkOut');//checkout device
Route::post('/prepaired/addnote', 'prepairedOrdersController@addNote');//add note

// Repairing Orders
Route::get('/repairing', 'RepairingOrdersController@index');
Route::post('/repairing/healthy','repairingOrdersController@healthy');//device is well
Route::post('/repairing/unrepairable', 'repairingOrdersController@unrepairable');//device is unrepairable
Route::post('/repairing/putoff', 'repairingOrdersController@putoff');//device is putted off by customer
Route::post('/repairing/addnote', 'repairingOrdersController@addNote');//add note
Route::post('/repairing/addrepaired', 'repairingOrdersController@addRepaired');//repaired order



