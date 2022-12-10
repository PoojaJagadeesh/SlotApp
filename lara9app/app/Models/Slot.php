<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'vehicle_number', 'booking_start','license','booking_end','fee','parkslot_id'
    ];
}
