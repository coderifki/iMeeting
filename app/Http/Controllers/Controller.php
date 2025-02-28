<?php

namespace App\Http\Controllers;

use App\Models\RoomModel;
use App\Models\UnitModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function create()
    {
        $units = UnitModel::all(); // Ambil semua unit
        $rooms = RoomModel::all(); // Ambil semua room

        return view('add_room', compact('units', 'rooms'));
    }
}
