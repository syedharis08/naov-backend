<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_id',
        'notes'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(InquiryDocument::class,'document_id');
    }
}
