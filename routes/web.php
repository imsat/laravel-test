<?php

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
//    Redis::set('rtr', '4v');
//    $value = Redis::get('rtr');
//    dd($value);
    return view('welcome');
});

Route::post('/', function () {
    Mail::to('satyajit.cse@yahoo.com')->send(new OrderShipped());
    return redirect('/');
});
