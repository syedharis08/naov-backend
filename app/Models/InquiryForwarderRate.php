<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_id',
        'forwarder_id',
        'loading_port_id',
        'destination_port_id',
        'carrier_id',
        'validity_rate',
        'free_days',
        'closing_date',
        'vessel_departure',
        'ship_transit_time',
        'vessel_arrival',
        'rate',
        'via_ports',
        'is_direct_route',
        'status',
    ];

    public function inquiryForwarderContainerRate()
    {
        return $this->hasMany(InquiryForwarderContainerRate::class);
    }
    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}

