<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryContainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_id',
        'container_id',
        'quantity',
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

//    public function
}
