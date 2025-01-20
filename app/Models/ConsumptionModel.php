<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumptionModel extends Model
{
    use HasFactory;
    protected $table = 'consumptions';
    protected $fillable = [
        'meeting_id',
        'type',
        'quantity',
        'cost_per_unit',
        'total_cost',
    ];
}
