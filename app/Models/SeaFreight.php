<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeaFreight extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'shipper_id',
        'loading_port_id',
        'destination_port_id',
        'sea_freight_type',
        'date',
    ];
}
