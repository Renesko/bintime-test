<?php

use App\Models\Product;

Route::get('/', 'OrderController@orderForm');

Route::model('product', Product::class);
Route::bind('product', function ($value) {
    return Product::find($value);
});
Route::get('/product/{product}/price', 'OrderController@getPrice');

Route::post('/order', 'OrderController@makeOrder');

Route::get('/search-form', 'OrderController@searchForm');

Route::post('/search', 'OrderController@search');

Route::get('/search/result', ['as' => 'search.result', 'uses' => 'OrderController@searchResult']);