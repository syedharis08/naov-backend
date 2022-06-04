<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id',
        'document_path',
        'document_type',
        'document_name'
    ];

    public function getDocumentPathAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function notes()
    {
        return $this->hasMany(DocumentNote::class,'document_id');
    }
}
