<?php
namespace App\Http\Controllers;

use App\Models\ConsumptionModel;
use App\Models\MeetingModel;
use App\Models\RoomModel;
use App\Models\UnitModel;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function create()
    {
        $rooms = RoomModel::all();
        return view('meetings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'meeting_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'participants' => 'required|integer|min:1',
        ]);

        // Validasi Kapasitas Ruangan
        $room = RoomModel::findOrFail($request->room_id);
        if ($request->participants > $room->capacity) {
            return back()->withErrors(['participants' => 'Jumlah peserta tidak boleh lebih besar dari kapasitas ruangan.']);
        }

        // Hitung Konsumsi Berdasarkan Waktu
        $start_time = strtotime($request->start_time);
        $end_time = strtotime($request->end_time);
        $participants = $request->participants;

        $consumptions = [];
        $total_cost = 0;

        // Snack Siang
        if ($start_time < strtotime('11:00') || $end_time > strtotime('11:00')) {
            $consumptions[] = [
                'type' => 'Snack Siang',
                'cost_per_unit' => 20000,
            ];
        }

        // Makan Siang
        if ($start_time < strtotime('14:00') && $end_time > strtotime('11:00')) {
            $consumptions[] = [
                'type' => 'Makan Siang',
                'cost_per_unit' => 30000,
            ];
        }

        // Snack Sore
        if ($start_time >= strtotime('14:00') || $end_time > strtotime('14:00')) {
            $consumptions[] = [
                'type' => 'Snack Sore',
                'cost_per_unit' => 20000,
            ];
        }

        // Hitung Total Konsumsi
        foreach ($consumptions as &$consumption) {
            $consumption['quantity'] = $participants;
            $consumption['total_cost'] = $participants * $consumption['cost_per_unit'];
            $total_cost += $consumption['total_cost'];
        }

        // Simpan Meeting
        $meeting = MeetingModel::create([
            'room_id' => $request->room_id,
            'meeting_date' => $request->meeting_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'participants' => $participants,
            'total_cost' => $total_cost,
        ]);

        // Simpan Konsumsim
        foreach ($consumptions as $consumption) {
            $meeting->consumptions()->create($consumption);
        }

        return redirect()->route('meetings.create')->with('success', 'Meeting berhasil dipesan!');
    }

    public function getUnits()
    {
        $units = UnitModel::units();
        return response()->json($units);
    }
}
