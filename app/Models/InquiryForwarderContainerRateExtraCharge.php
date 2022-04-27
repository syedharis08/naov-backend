<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderContainerRateExtraCharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_forwarder_container_rate_id',
        'name',
        'rate',
    ];
    /**
     * Get the inquiryForwarderContainerRate that owns the InquiryForwarderContainerRateExtraCharge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inquiryForwarderContainerRate()
    {
        return $this->belongsTo(InquiryForwarderContainerRate::class);
    }
}
