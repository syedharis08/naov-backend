<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens as PassportHasApiTokens;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  PassportHasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function forwarders()
    {
        return $this->belongsToMany(User::class,'forwarder_users','user_id','forwarder_id');
    }

    public function forwaderusers()
    {
        return $this->belongsToMany(User::class,'forwarder_users','forwarder_id','user_id');
    }

     public function shippers()
    {
        return $this->belongsToMany(User::class,'shipper_users','user_id','shipper_id');
    }

    public function shipperusers()
    {
        return $this->belongsToMany(User::class,'shipper_users','shipper_id','user_id');
    }
}
