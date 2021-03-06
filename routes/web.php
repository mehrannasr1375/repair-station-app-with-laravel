<?php

// Auth
Auth::routes(['register' => false]);
Route::get('/logout', 'DashboardController@logout');
Route::get('/login', 'Auth\LoginController@showLoginForm')->middleware('hasAdmin')->name('login');
Route::view('/signup', 'auth.signup');
Route::post('/signup', 'SignupController@store');


// Dashboard & Home
Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/home', 'DashboardController@index');
Route::post('/dashboard/search', 'DashboardController@search');


// Prepaired Orders
Route::get('/prepaired', 'PrepairedOrdersController@index');
Route::get('/prepaired/count/{count}', 'PrepairedOrdersController@index'); // For Paginator
Route::post('/prepaired/checkout','prepairedOrdersController@checkOut');
Route::post('/prepaired/addnote', 'prepairedOrdersController@addNote');


// Repairing Orders
Route::get('/repairing', 'RepairingOrdersController@index');
Route::get('/repairing/count/{count}', 'RepairingOrdersController@index'); //for Paginator
Route::post('/repairing/healthy','repairingOrdersController@healthy');
Route::post('/repairing/unrepairable', 'repairingOrdersController@unrepairable');
Route::post('/repairing/putoff', 'repairingOrdersController@putoff');
Route::post('/repairing/addnote', 'repairingOrdersController@addNote');
Route::post('/repairing/addrepaired', 'repairingOrdersController@addRepaired');


// Customers
Route::get('/customers', 'CustomersController@index');
Route::get('/customers/search/{search}', 'CustomersController@searchCustomer');
Route::get('/customers/return/{type}', 'CustomersController@index');
Route::get('/customers/return/{type}/count/{count}', 'CustomersController@index'); //for Paginator & customers type
Route::get('/customers/create', 'CustomersController@create');
Route::post('/customers', 'CustomersController@store');
Route::get('/customers/{customer}', 'CustomersController@show');
Route::get('/customers/{customer}/edit', 'CustomersController@edit');
Route::patch('/customers/{customer}', 'CustomersController@update');
Route::post('/customers/delete/{customer}', 'CustomersController@destroy');
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
Route::post('/orders/addpayment', 'OrdersController@addPayment');


// Reminders
Route::post('/dashboard/reminder', 'RemindersController@store');
Route::post('/dashboard/removereminder/{reminder}', 'RemindersController@destroy');
