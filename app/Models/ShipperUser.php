<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipperUser extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id','shipper_id','status'
    ];
 }
