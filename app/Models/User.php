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

    protected $fillable = [
        'role_id',
        'company_name',
        'company_email',
        'name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'is_logged_in',
        'is_terms_and_conditions',
        'remember_token',
        'created_at',
        'updated_at'
    ];

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
        return $this->belongsToMany(User::class, 'forwarder_users', 'forwarder_id','user_id' ,'id');
    }

    public function forwaderusers()
    {
        return $this->belongsToMany(User::class, 'forwarder_users', 'forwarder_id', 'user_id');
    }

    public function shippers()
    {
        return $this->belongsToMany(User::class, 'shipper_users', 'shipper_id','user_id','id' );
    }

    public function shipperusers()
    {
        return $this->belongsToMany(User::class, 'shipper_users', 'shipper_id', 'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function inquiryForwarderRate()
    {
        return $this->hasMany(InquiryForwarderRate::class, 'forwarder_id');
    }


    public function inquiryForwarder()
    {
        return $this->hasMany(InquiryForwarder::class, 'forwarder_id');
    }

    public function document()
    {
        return $this->hasMany(InquiryDocument::class);
    }

    public function shipperInquiries()
    {
        return $this->hasMany(Inquiry::class, 'shipper_id');
    }
}
