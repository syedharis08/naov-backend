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
    ];


    public function inquiryForwarderRate()
    {
        return $this->hasMany(InquiryForwarderRate::class);
    }
}
