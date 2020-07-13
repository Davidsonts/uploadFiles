<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

$router->get('/api/', 'Api\UploadsController@index')->name('api');
$router->post('/api/store', 'Api\UploadsController@store');
$router->get('/api/show/{id}', 'Api\UploadsController@show');
$router->put('/api/update/{id}', 'Api\UploadsController@index');
$router->delete('/api/destroy/{id}', 'Api\UploadsController@index');

