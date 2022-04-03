<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderContainerRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_forwarder_rate_id',
        'container_id',
        'num_of_containers',
        'exw_charge',
        'rate',
    ];
}
