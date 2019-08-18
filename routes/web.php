<?php


Auth::routes();

Route::view('/', 'layouts.app');

Route::get('/customers', 'CustomersController@index');