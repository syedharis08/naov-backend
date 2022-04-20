<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderContainerRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_forwarder_rate_id',
        'inquiry_container_id',
        'exw_charge',
        'rate',
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function inquiryForwarderContainerCarrierRate()
    {
        return $this->hasMany(InquiryForwarderContainerCarrierRate::class);
    }

    public function inquiryContainer(){
        $this->belongsTo(InquiryContainer::class);
    }
}
