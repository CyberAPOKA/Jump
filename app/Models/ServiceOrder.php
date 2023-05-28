<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_plate',
        'entry_date_time',
        'exit_date_time',
        'price_type',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
