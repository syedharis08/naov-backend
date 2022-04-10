<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'forwarder_id',
        'volume',
        'weight',
        'notes',
        'is_dangerous',
    ];

    public function seaFreight()
    {
        return $this->hasOne(SeaFreight::class);
    }

    public function inquiryForwarderRates()
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


}
