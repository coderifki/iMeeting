<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingModel extends Model
{
    use HasFactory;

    protected $table = 'meetings';
    protected $fillable = [
        'room_id',
        'meeting_date',
        'start_time',
        'end_time',
        'participants',
        'total_cost',
    ];

    public function room()
    {
        return $this->belongsTo(RoomModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consumptions()
    {
        return $this->hasMany(ConsumptionModel::class);
    }
}
