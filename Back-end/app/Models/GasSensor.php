<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasSensor extends Model
{
    use HasFactory;
    protected $table = "gas_sensors";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [

        'current_consumption',
        'user_id',
        'status' ,
        'start_cut_time' ,
        'end_cut_time' , 

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
