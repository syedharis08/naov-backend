<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_forwarder_id',
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
        'confirm_spaces',
        'rate',
        'is_direct_route',
        'status',
    ];

    public function inquiryForwarderContainerRates()
    {
        return $this->hasMany(InquiryForwarderContainerRate::class);
    }

    public function extraCharges()
    {
        return $this->hasMany(InquiryForwarderExtraCharge::class);
    }

    public function viaPorts()
    {
        return $this->hasMany(InquiryForwarderViaPort::class);
    }
    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
    public function inquiryForwarder()
    {
        return $this->belongsTo(InquiryForwarder::class);
    }
}


