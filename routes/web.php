<?php

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use Elastic\Elasticsearch\ClientBuilder;

Route::get('/', function () {
//    Redis::set('rtr', '4v');
//    $value = Redis::get('rtr');
//    dd($value);
//    $client = ClientBuilder::create()->build();
//    dd($client);
    return view('welcome');
});

Route::post('/', function () {
    Mail::to('satyajit.cse@yahoo.com')->send(new OrderShipped());
    return redirect('/');
});


Route::get('/enter/{age}/{name}', function ($age, $name) {
    $client = ClientBuilder::create()->build();    //connect with the client
//    dd($client);
    $params = array();
    $params['body'] = array(
        'name' => $name,                                            //preparing structred data
        'age' => $age

    );
    $params['index'] = 'laravel_test';
    $params['type'] = 'laravel_test_owner';
    $result = $client->index($params);                            //using Index() function to inject the data
    return $result;
});

Route::get('find/{age}', function ($age) {
    $client = ClientBuilder::create()->build();        //connect to the client
    $params['index'] = 'laravel_test';                        // Preparing Indexed Data
    $params['type'] = 'laravel_test_owner';
    $params['body']['query']['match']['age'] = $age;            //Find data in which age matches given input
    $result = $client->search($params);
//    dd($result);
    return response()->json($result);
});
