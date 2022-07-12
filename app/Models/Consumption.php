<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;
    protected $table = "consumptions";
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
