<?php

// Auth
Auth::routes(['register' => false]);
Route::get('/logout', 'DashboardController@logout');



// Dashboard & Home
Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/home', 'DashboardController@index');



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



// Customers
Route::get('/customers/return/{type}', 'CustomersController@index');
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




// Reminders
Route::get('/dashboard/reminder/create', 'RemindersController@create');
Route::post('/dashboard/reminder', 'RemindersController@store');
Route::post('/dashboard/removereminder/{reminder}', 'RemindersController@destroy');
