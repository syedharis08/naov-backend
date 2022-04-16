<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarder extends Model
{
    use HasFactory;
    protected  $fillable = [
        'inquiry_id',
        'forwarder_id',
        'status',
        'inquiry_forwarder_id',
        'ref_forwarder_status'
    ];

    public function inquiryForwarderRate()
    {
        return $this->hasMany(InquiryForwarderRate::class,'inquiry_forwarder_id');
    }

    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }

    public function inquiryExtendedForwarders()
    {
        return $this->hasMany(InquiryForwarder::class,'inquiry_forwarder_id');
    }

}
