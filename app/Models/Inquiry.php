<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    const UPLOAD_DIRECTORY = 'inquiries/Documents';

    protected $fillable = [
        'user_id',
        'service_id',
        'forwarder_id',
        'shipper_id',
        'company_inquiry_id',
        'volume',
        'commodity',
        'weight',
        'notes',
        'is_dangerous',
        'status'
    ];

    public function seaFreight()
    {
        return $this->hasOne(SeaFreight::class);
    }

    public function inquiryForwarder()
    {
        return $this->hasMany(InquiryForwarder::class);
    }

    public function inquiryForwarderRates()
    {
        return $this->hasManyThrough(InquiryForwarderRate::class, InquiryForwarder::class)
            ->where('ref_forwarder_status','!=',2);
    }

    public function inquiryForwarderRate()
    {
        return $this->hasMany(InquiryForwarderRate::class);
    }

    public function inquiryRates()
    {
        return $this->hasMany(InquiryForwarderRate::class);
    }


    public function inquireForwarderContainerRates()
    {
        return $this->hasManyThrough(InquiryForwarderContainerRate::class,InquiryForwarderRate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function inquiryContainers()
    {
        return $this->hasMany(InquiryContainer::class);
    }

    public function inquiryRateAccepted()
    {
        return $this->hasOne(InquiryForwarderRate::class)->where('status','>',0);
    }

    public function inquiryDocuments()
    {
        return $this->hasMany(InquiryDocument::class);
    }

    public function shipper()
    {
        return $this->belongsTo(User::class,'shipper_id');
    }

    public function forwarder()
    {
        return $this->belongsTo(User::class,'forwarder_id');
    }

    public function inquiryForwarderDeleted()
    {
        return $this->hasMany(InquiryForwarder::class)->withTrashed();
    }
}
