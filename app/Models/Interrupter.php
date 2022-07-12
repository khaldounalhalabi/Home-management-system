<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interrupter extends Model
{
    use HasFactory;
    protected $table = "interrupters";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable =
    [
        'user_id',
        'room_device',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
