<?php

use App\Http\Controllers\Controller;
use App\Models\RoomModel;
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

Route::get('/create_roomeeting', [Controller::class, 'create'])->name('add_room'); // Route ke method create()

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/api/rooms/{id}', function ($id) {
    $room = RoomModel::find($id);
    if ($room) {
        return response()->json(['capacity' => $room->capacity]);
    } else {
        return response()->json(['error' => 'Room not found'], 404);
    }
});