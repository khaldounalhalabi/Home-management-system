<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = "bills";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'date',
        'value',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
