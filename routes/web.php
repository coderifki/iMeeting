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

Route::get('/create_roomeeting', function () {
    return view('add_room');
})->name('add_room'); // Added route name for add_room

Route::get('/', function () {
    return view('homepage');
})->name('homepage'); // Added route name for homepage
