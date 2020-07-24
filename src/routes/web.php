<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'AhmetSerefoglu\RecursingLichterman\Http\Controllers'],function(){

    Route::post('users/create','UserController@store');
    Route::post('books/create','BooksController@store');
    Route::get('books/{book_id}','BooksController@show');
    Route::post('books/{book_id}/delivery','BooksController@booksDeliveryStore');
    Route::get('authors/{author_id}','BooksController@authorBook');
    Route::get('label/{label_id}','BooksController@labelBook');
    Route::post('books/{book_id}/delivery/delete','BooksController@booksDeliveryDelete');
    Route::post('booksdelivery/{book_id}','BooksController@booksDeliveryShow');
});