<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    protected $table = "sensors";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable =
    [
        'interrupter_status',
        'current_consumption',
        'allowed_consumption',
        'alowed_consumption_cost',
        'user_id',
        'start_cut_time',
        'end_cut_time',
        'current_voltage',
        'start_peak_time',
        'end_peak_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
