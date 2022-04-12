<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForwarderViaPort extends Model
{
    use HasFactory;
    protected $fillable = [
        'port_id'
    ];

    public function seaPort()
    {
        return $this->belongsTo(SeaPort::class,'port_id');
    }

}
