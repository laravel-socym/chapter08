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


use Illuminate\Contracts\Console\Kernel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/no_args', function () {
    Artisan::call('no-args-command');
});
Route::get('/with_args', function () {
    Artisan::call('with-args-command', [
        'arg'      => 'value',
        '--switch' => false,
    ]);
});

Route::get('/no_args_di', function (Kernel $artisan) {
    $artisan->call('no-args-command');
});
