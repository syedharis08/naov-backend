<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InquiryForwarder extends Model
{
    use HasFactory,SoftDeletes;
    protected  $fillable = [
        'inquiry_id',
        'forwarder_id',
        'status',
        'rate_status',
        'inquiry_forwarder_id',
        'ref_forwarder_status'
    ];

    public function inquiryForwarderRate()
    {
        return $this->hasMany(InquiryForwarderRate::class, 'inquiry_forwarder_id');
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function inquiryExtendedForwarders()
    {
        return $this->hasMany(InquiryForwarder::class, 'inquiry_forwarder_id');
    }

    public function forwarder()
    {
        return $this->belongsTo(User::class, 'forwarder_id');
    }

}
