<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasConsumption extends Model
{
    use HasFactory;
    protected $table = "gas_consumtions";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable =
    [
        'user_id',
        'consumption_per_day',
        'date',
        'cost',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
