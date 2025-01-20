<?php

namespace App\Http\Controllers;
use App\Models\Unit;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create()
    {
        $units = Unit::all(); // Get all unit

        return view('views/add_room', compact('units'));
    }
}
