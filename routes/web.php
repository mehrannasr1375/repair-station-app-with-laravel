<?php


// Auth
Auth::routes();


// Home
Route::view('/', 'layouts.app');


// Customers
Route::get('/customers', 'CustomersController@index');
Route::get('/customers/create', 'CustomersController@create');
Route::post('/customers', 'CustomersController@store');


