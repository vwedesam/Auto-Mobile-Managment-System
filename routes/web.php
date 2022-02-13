<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/dashboard', 'HomeController@index');

Route::get('/setup', 'HomeController@app_setup')->name('app_setup');

// Api Route For Ajax Request
Route::get('make/{product_id}/fetch', 'MakeController@fetch')->name('make.fetch');
Route::get('model/{make_id}/fetch', 'ModelController@fetch')->name('model.fetch');
Route::post('product/fetch', 'ProductController@fetch')->name('product.fetch');
Route::post('/invoice/fetch', 'InvoiceController@fetch')->name('invoice.fetch');
Route::post('/miscellaneous/fetch', 'MiscellaneousController@fetch')->name('miscellaneous.fetch');

// Summary Route
Route::get('/summary', 'SummaryController@index')->name('summary.index');
Route::get('/summary/{from_date}/{to_date}/print', 'SummaryController@print')->name('summary.print');


// Users Route
Route::get('/users', 'UserController@index')->name('user.index');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
Route::post('/user', 'UserController@store')->name('user.store');
Route::put('/user/{user}', 'UserController@update')->name('user.update');
Route::post('/user/login', 'UserController@update_login')->name('user.update.login');

// Sales Route 
Route::get('sales', 'SalesController@show')->name('sales.index');
Route::delete('sales/{cart}', 'SalesController@destroy')->name('sales.destroy');
Route::post('sales/add', 'SalesController@add')->name('sales.add');
Route::post('sales/empty', 'SalesController@empty')->name('sales.empty');
Route::put('sales/{cart}/update', 'SalesController@update')->name('sales.update');

Route::get('transfer', 'TransferController@show')->name('transfer.index');
Route::delete('transfer/{cart}', 'TransferController@destroy')->name('transfer.destroy');
Route::post('transfer/add', 'TransferController@add')->name('transfer.add');
Route::post('transfer/empty', 'TransferController@empty')->name('transfer.empty');
Route::put('transfer/{cart}/update', 'TransferController@update')->name('transfer.update');

// Sales Invoice Route 
Route::post('invoice', 'InvoiceController@store')->name('invoice.store');
Route::get('/invoice/{invoice_id}/view', 'InvoiceController@show')->name('invoice.view');
Route::get('/invoice/{invoice_id}/print', 'InvoiceController@print')->name('invoice.print');

// Destroy For Product And Miscellaneous

Route::delete('miscellaneous/{miscellaneous_id}/destroy', 'MiscellaneousController@destroy')->name('miscellaneous.destroy');
Route::delete('product/{product_id}/destroy', 'ProductController@destroy')->name('product.destroy');

// Update Product Stock
Route::get('product/{product_id}/edit_stock', 'ProductController@edit_stock')->name('product.stock');
Route::post('product/{product_id}/stock', 'ProductController@update_stock')->name('product.stock_update');

// Update Miscellaneous Stock
Route::get('miscellaneous/{product_id}/edit_stock', 'MiscellaneousController@edit_stock')->name('miscellaneous.stock');
Route::post('miscellaneous/{product_id}/stock', 'MiscellaneousController@update_stock')->name('miscellaneous.stock_update');

Route::resource('miscellaneous', 'MiscellaneousController')->except(['destroy']);
Route::resource('product', 'ProductController')->except(['destroy']);
Route::resource('product_name', 'ProductNameController')->except(['show', 'create']);
Route::resource('product_make', 'MakeController')->except(['show', 'create']);
Route::resource('product_model', 'ModelController')->except(['show', 'create']);
Route::resource('dealer_info', 'DealerInfoController')->except(['destroy', 'show']);
Route::resource('customer', 'CustomerController')->except(['show']);



