<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderExtraCharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_forwarder_rate_id',
        'charge_name',
        'rate',
    ];
}
