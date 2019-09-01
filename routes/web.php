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

// Orders history
Route::get('/orders', 'OrdersController@index');
Route::get('/orders/create', 'OrdersController@create');
Route::post('/orders', 'OrdersController@store');
Route::get('/orders/{order}', 'OrdersController@show');
Route::get('/orders/{order}/edit', 'OrdersController@edit');
Route::patch('/orders/{order}', 'OrdersController@update');

// Prepaired Orders
Route::get('/prepaired', 'PrepairedOrdersController@index');


// Repairing Orders
Route::get('/repairing', 'RepairingOrdersController@index');
Route::post('/repairing/healthy','repairingOrdersController@healthy');//device is well




