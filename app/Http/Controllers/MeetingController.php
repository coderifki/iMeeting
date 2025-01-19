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
        // Validasi Input
        $request->validate([
            'unit' => 'required',
            'room' => 'required|exists:rooms,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'participants' => 'required|integer|min:1',
        ], [
            'room.exists' => 'Ruang meeting yang dipilih tidak valid.',
            'end_time.after' => 'Waktu selesai harus lebih besar dari waktu mulai.',
        ]);

        // Validasi tambahan: Jumlah peserta tidak boleh lebih besar dari kapasitas ruangan
        $room = RoomModel::findOrFail($request->room);
        if ($request->participants > $room->capacity) {
            return back()->withErrors(['participants' => 'Jumlah peserta tidak boleh lebih besar dari kapasitas ruangan.']);
        }

        // 1. Simpan ke tabel meetings
        $meeting = MeetingModel::create([
            'room_id' => $request->room,
            'meeting_date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'participants' => $request->participants,
            'total_cost' => 0, // Akan diupdate setelah konsumsi dihitung
        ]);

        // 2. Hitung konsumsi berdasarkan waktu
        $consumptions = [];
        $startTime = strtotime($request->start_time);
        $endTime = strtotime($request->end_time);

        // Aturan konsumsi otomatis
        if ($startTime < strtotime('11:00:00')) {
            $consumptions[] = [
                'meeting_id' => $meeting->id,
                'type' => 'Snack Pagi',
                'quantity' => $request->participants,
                'cost_per_unit' => 20000,
                'total_cost' => $request->participants * 20000,
            ];
        }
        if ($endTime >= strtotime('11:00:00') && $startTime <= strtotime('14:00:00')) {
            $consumptions[] = [
                'meeting_id' => $meeting->id,
                'type' => 'Makan Siang',
                'quantity' => $request->participants,
                'cost_per_unit' => 30000,
                'total_cost' => $request->participants * 30000,
            ];
        }
        if ($endTime > strtotime('14:00:00')) {
            $consumptions[] = [
                'meeting_id' => $meeting->id,
                'type' => 'Snack Sore',
                'quantity' => $request->participants,
                'cost_per_unit' => 20000,
                'total_cost' => $request->participants * 20000,
            ];
        }

        // 3. Simpan ke tabel consumptions
        foreach ($consumptions as $consumption) {
            ConsumptionModel::create($consumption);
        }

        // 4. Update total_cost di tabel meetings
        $totalCost = array_sum(array_column($consumptions, 'total_cost'));
        $meeting->update(['total_cost' => $totalCost]);

        // 5. Redirect atau response
        return redirect()->route('homepage')->with('success', 'Meeting berhasil ditambahkan!');
    }

}
